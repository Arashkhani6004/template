<?php

namespace Rahweb\CmsCore\Modules\Order\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Rahweb\CmsCore\Modules\Order\DTO\DiscountDTO;
use Rahweb\CmsCore\Modules\Order\Entities\Basket;
use Rahweb\CmsCore\Modules\Order\Entities\BasketItem;
use Rahweb\CmsCore\Modules\Order\Entities\Discount;
use Rahweb\CmsCore\Modules\Order\Entities\OrderShippingStatus;
use Rahweb\CmsCore\Modules\Product\Entities\ProductVariant;

class DiscountService
{
    public function create(DiscountDTO $discountDTO)
    {
        Discount::create([
            'title' => $discountDTO->getTitle(),
            'max_usage_per_user' => $discountDTO->getMaxUsagePerUser(),
            'basket_minimum_price' => $discountDTO->getBasketMinimumPrice(),
            'count' => $discountDTO->getCount(),
            'amount' => $discountDTO->getAmount(),
            'type' => $discountDTO->getType(),
            'user_id' => $discountDTO->getUserId(),
            'first_purchase' => $discountDTO->getFirstPurchase(),
            'with_discount' => $discountDTO->getWithDiscount(),
        ]);
    }

    public function update(int $id, DiscountDTO $discountDTO)
    {
        $discount = Discount::findOrfail($id);

        $discount->update([
            'title' => $discountDTO->getTitle(),
            'max_usage_per_user' => $discountDTO->getMaxUsagePerUser(),
            'basket_minimum_price' => $discountDTO->getBasketMinimumPrice(),
            'count' => $discountDTO->getCount(),
            'amount' => $discountDTO->getAmount(),
            'type' => $discountDTO->getType(),
            'user_id' => $discountDTO->getUserId(),
            'first_purchase' => $discountDTO->getFirstPurchase(),
            'with_discount' => $discountDTO->getWithDiscount(),
        ]);

    }

    public function deleteOne(int $id): void
    {
        $discount = Discount::findOrFail($id);

        $discount->delete();
    }

    //
    public static function findAll($query = [], $except_id = null, $limit = null)
    {
        $statuses = OrderShippingStatus::query();
        if ($except_id) {
            $statuses->where('id', '<>', $except_id);
        }

        if (isset($query['title'])) {
            $statuses->where('title', 'LIKE', '%' . $query['title'] . '%');
        }
        if ($limit != null) {
            return $statuses->orderby('id', 'DESC')->take($limit)->get();
        } else {
            return $statuses->orderby('id', 'DESC')->get();
        }
    }

    public static function checkDiscount($discount_code)
    {
        $basket = Basket::authUser()->orderBy('id', 'DESC')->first();
        $discount = Discount::orderBy('id', 'DESC')->where('title', $discount_code)->first();
        if (!$discount) {
            return response()->json([
                'success' => false,
                'button' => false,
                'message' => 'کد تخفیف نامعتبر است.',
            ], 200);
        }
        return self::checkDiscountValidity($basket, $discount);


    }

    public static function checkDiscountValidity($basket, $discount)
    {
        $user = Auth::user();
        if ($basket->discount_id != null) {
            return response()->json([
                'success' => false,
                'button' => false,
                'sign' => 'error',
                'message' => 'شما قبلا برای این سبد کد تخفیف  استفاده کردید',
            ], 200);

        }
        if ($discount->user_id != null && $discount->user_id != $user->id) {
            return response()->json([
                'success' => false,
                'button' => false,
                'message' => 'این کد تخفیف متعلق به شما نیست.',
            ], 200);
        }
        if ($discount->count != null && (count($discount->orders) >= $discount->count)) {
            return response()->json([
                'success' => false,
                'button' => false,
                'message' => 'تعداد دفعات استفاده از این کد تخفیف به پایان رسیده است',
            ], 200);
        }
        if ($discount->max_usage_per_user != null && (count($user->orders) > $discount->max_usage_per_user)) {
            return response()->json([
                'success' => false,
                'button' => false,
                'message' => 'تعداد دفعات استفاده از این کد تخفیف به پایان رسیده است',
            ], 200);
        }
        if ($discount->first_purchase == 1 && (count($user->orders) != 0)) {
            return response()->json([
                'success' => false,
                'button' => false,
                'message' => 'این کد تخفیف مخصوص خرید اول می باشد',
            ], 200);
        }
        return self::applyDiscountToBasket($basket, $discount);

    }

    public static function applyDiscountToBasket($basket, $discount)
    {

        $items = $basket->items;
        if (count($items) == 0) {
            return response()->json([
                'success' => false,
                'button' => false,
                'message' => 'کد تخفیف مورد نظر قابل اعمال برای این محصولات نمی باشد',
            ], 200);
        }
        $sum = 0;
        foreach ($items as $item) {

            if ($discount->with_discount == 1) {

                $qty = $item->quantity;
                $price = $item->product_variant_id != null ? $item->productVariant->final_price : $item->product->final_price;
                $item_total = $price * $qty;
                $sum += $item_total;
            } else {
                $itemsWithDiscount = $basket->items->filter(function ($item) {
                    return intval($item->discounted_price) != 0;
                });


                if (count($itemsWithDiscount) == 0) {
                    return response()->json([
                        'success' => false,
                        'button' => false,
                        'message' => 'در سبد شما محصول بدون تخفیفی وجود ندارد',
                    ], 200);
                }
                if (intval($item->product->discounted_price) == 0) {
                    $qty = $item->quantity;
                    $price = $item->product_variant_id != null ? $item->productVariant->final_price : $item->product->final_price;
                    $item_total = $price * $qty;
                    $sum += $item_total;
                }
            }
        }
        if ($discount->basket_minimum_price != 0 && ($sum < $discount->basket_minimum_price)) {
            $x = number_format($discount->basket_minimum_price);
            return response()->json([
                'success' => false,
                'button' => false,
                'message' => ' برای استفاده از این کد تخفیف، مجموع محصولات بدون تخفیف حداقل بایستی ' . $x . ' تومان باشد. ',
            ], 200);
        }
        $basket->update(
            [
                'discount_id' => $discount->id,
            ]
        );


        return response()->json([
            'success' => true,
            'message' => 'کد تخفیف با موفقیت اعمال شد',
            'discount_id' => $discount->id,
        ], 200);
    }

    public static function listPrice()
    {
        $basket = Basket::authUser()->orderBy('id', 'DESC')->first();
        $final_price_sum = 0;
        $price_sum = 0;
        foreach ($basket->items as $item) {
            $final_price = $item->product_variant_id ? $item->productVariant->final_price : $item->product->final_price;
            $final_price_quantity = $final_price * $item->quantity;
            $price = $item->product_variant_id ? $item->productVariant->price : $item->product->price;
            $price_quantity = $price * $item->quantity;
            $final_price_sum += $final_price_quantity;
            $price_sum += $price_quantity;
        }
        $price_discount = $price_sum - $final_price_sum;
        $price_shipping = $basket->shippingMethod ? intval($basket->shippingMethod->price) : "";

        $discount = $basket->discount_id ? $basket->discount->amount : 0;
        $discount_amount = 0;
        if ($basket->discount_id != null) {
            if ($basket->discount->type == "percent") {
                $discount_amount = intval($final_price_sum) * intval($basket->discount->amount) / 100;
            } else {
                $discount_amount = intval($basket->discount->amount);
            }
        }


        $price_cart = $price_shipping ? intval($final_price_sum) - $discount_amount + $price_shipping : $final_price_sum - $discount_amount;
        return ['final_price_sum' => $final_price_sum, 'price_sum' => $price_sum, 'price_discount' => $price_discount,
            'price_shipping' => $price_shipping, 'price_cart' => $price_cart, 'discount_amount' => $discount_amount];
    }
}
