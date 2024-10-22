<?php

namespace Rahweb\CmsCore\Modules\Order\Services;

use Illuminate\Support\Facades\Auth;
use Rahweb\CmsCore\Modules\Order\Entities\Basket;
use Rahweb\CmsCore\Modules\Order\Entities\BasketItem;
use Rahweb\CmsCore\Modules\Product\Entities\Product;
use Rahweb\CmsCore\Modules\Product\Entities\ProductVariant;


class BasketService
{
    //addToBasket
    public static function create($product_id, $product_variant_id, $quantity, $cart = false)
    {
        $basket = Basket::authUser()->orderBy('id', 'DESC')->first();
        if (!$basket) {
            $basket = Basket::create([
                'user_id' => @\Auth::id()
                , 'user_cookie' => session()->get('custom_data'),
            ]);
        }
        return self::checkValidity($product_id, $product_variant_id, $quantity, $basket, $cart);

    }

    public static function checkValidity($product_id, $product_variant_id, $quantity, $basket, $cart)
    {
        $product = Product::find($product_id);
        if ($product->stock == 0) {
            return response()->json([
                'success' => false,
                'button' => false,
                'message' => 'محصول مورد نظر موجود نمی باشد.',
            ], 200);
        }
        $item = null;
        if (count($product->variants) > 0) {
            $main_variant_title = $product->mainVariant->title;

            if (@$product_variant_id == null) {
                return response()->json([
                    'success' => false,
                    'button' => false,
                    'swal' => true,
                    'message' => 'انتخاب ' . @$main_variant_title . ' الزامیست ',
                ], 200);
            }
            $item = BasketItem::whereBasketId($basket->id)->whereProductId($product->id)->where('product_variant_id', $product_variant_id)->first();
            $variant = ProductVariant::find($product_variant_id);
            $stock = $variant ? $variant->stock : 0;
        } else {
            $item = BasketItem::whereBasketId($basket->id)->whereProductId($product->id)->first();
            $stock = $product ? $product->stock : 0;
        }
        $item_quantity = $item ? intval($item->quantity) : 0;

        if (intval($quantity) > 0) {

            if (intval($product->final_price) != 0) {
                if ($cart) {
                    $main_quantity = intval($quantity);
                } else {
                    $main_quantity = intval($quantity) + $item_quantity;
                }

                if ($stock >= $main_quantity) {
                    self::addItems($product_id, $product_variant_id, $main_quantity, $basket);


                } else {
                    return response()->json([
                        'success' => false,
                        'button' => false,
                        'swal' => true,
                        'message' => 'موجودی انبار کافی نیست',
                    ], 200);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'button' => false,
                    'message' => 'محصول فاقد قیمت میباشد',
                ], 200);
            }
        }


    }

    public static function addItems($product_id, $product_variant_id, $quantity, $basket)
    {
        BasketItem::updateOrCreate(
            [
                'product_id' => $product_id,
                'product_variant_id' => $product_variant_id,
                'basket_id' => $basket->id,
            ],
            [
                'quantity' => $quantity,
            ]
        );
        return response()->json([
            'message' => 'محصول با موفقیت به سبد خرید اضافه شد.',
        ], 200);

    }

    //Cart
    public static function findBasketAndCheckStock()
    {
        $basket = Basket::authUser()->orderBy('id', 'DESC')->first();
        if ($basket) {
            foreach ($basket->items as $item) {

                if ($item->product_variant_id != null) {
                    if ($item->productVariant->stock == 0 || ($item->quantity > $item->productVariant->stock)) {
                        $item->delete();
                    }
                } else {
                    if ($item->product->stock == 0 || ($item->quantity > $item->product->stock)) {

                        $item->delete();
                    }
                }
                $basket->save();
            }
        }
        return $basket;
    }

    //delete
    public static function delete()
    {
        $basket = Basket::authUser()->orderBy('id', 'DESC')->first();
        if ($basket) {
            $basket->items()->delete();
            $basket->delete();
        }
    }

    public static function removeItem($itemId)
    {
        BasketItem::destroy($itemId);
    }

    public static function listPrice()
    {
        $basket = Basket::authUser()->orderBy('id', 'DESC')->first();
        $final_price_sum = 0;
        $price_sum = 0;
        if ($basket && count($basket->items) > 0) {
            foreach ($basket->items as $item) {
                $final_price = $item->product_variant_id ? $item->productVariant->final_price : $item->product->final_price;
                $final_price_quantity = $final_price * $item->quantity;
                $price = @$item->productVariant ? $item->productVariant->price : $item->product->price;
                $price_quantity = $price * $item->quantity;
                $final_price_sum += $final_price_quantity;
                $price_sum += $price_quantity;
            }
        }

        $price_discount = $price_sum - $final_price_sum;
        return ['final_price_sum' => $final_price_sum, 'price_sum' => $price_sum, 'price_discount' => $price_discount];
    }

    public static function addressPrice()
    {
        $basket = Basket::authUser()->orderBy('id', 'DESC')->first();
        $final_price_sum = 0;
        $price_sum = 0;
        foreach ($basket->items as $item) {
            $final_price = $item->product_variant_id ? $item->productVariant->final_price : $item->product->final_price;
            $final_price_quantity = $final_price * $item->quantity;
            $price = $item->product_variant_id ?
                (intval($item->productVariant->discounted_price) != 0 ? $item->productVariant->price : 0) :
                (intval($item->product->discounted_price) != 0 ? $item->product->price : 0);
            $price_quantity = $price * $item->quantity;
            $final_price_sum += $final_price_quantity;
            $price_sum += $price_quantity;
        }
        $price_discount = $price_sum - $final_price_sum;
        $price_shipping = $basket->shippingMethod ? intval($basket->shippingMethod->price) : "";
        $price_cart = $price_shipping ? intval($final_price_sum) + $price_shipping : $final_price_sum;
        return ['final_price_sum' => $final_price_sum, 'price_sum' => $price_sum, 'price_discount' => $price_discount,
            'price_shipping' => $price_shipping, 'price_cart' => $price_cart];
    }

    //auth
    public static function findUserBasketAndUpdateBaskets()
    {
        $currentBasket = Basket::cookieUser()->whereNotNull('user_cookie')->whereNull('user_id')->first();
        $currentBaskets = Basket::orderBy('id', 'DESC')->where('user_id', Auth::id())->where('id', '<>', @$currentBasket->id)->get();
        if ($currentBasket) {
            foreach ($currentBaskets as $row) {
                $row->delete();
            }
            $currentBasket->update([
                'user_id' => Auth::id(),
            ]);
        }
        return;
    }


}
