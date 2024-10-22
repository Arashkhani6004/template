<?php

namespace Rahweb\CmsCore\Modules\Order\Services;

use Illuminate\Support\Facades\Auth;
use Rahweb\CmsCore\Modules\General\Helper\Sms;
use Rahweb\CmsCore\Modules\Order\Entities\Bank;
use Rahweb\CmsCore\Modules\Order\Entities\InventoryTransaction;
use Rahweb\CmsCore\Modules\Order\Entities\Order;
use Rahweb\CmsCore\Modules\Order\Entities\OrderItem;
use Rahweb\CmsCore\Modules\Order\Entities\OrderShippingStatus;
use Rahweb\CmsCore\Modules\Order\Library\ZarinPalClass;
use Rahweb\CmsCore\Modules\Product\Entities\Product;
use Rahweb\CmsCore\Modules\Product\Entities\ProductVariant;
use Rahweb\CmsCore\Modules\Setting\Entities\Setting;


class OrderService
{
    public static function findByAuthority($authority)
    {

        return Order::orderBy('id', 'DESC')->where('transaction_info->post->Authority', $authority)->first();
    }

    public static function findById($id)
    {

        return Order::findOrfail($id);
    }

    //addToBasket
    public static function create($basket)
    {
        $currentOrder = Order::orderBy('id', 'DESC')->where('basket_id', $basket['id'])->first();
        if ($currentOrder != null) {
            $currentOrder->delete();
        }

        $currentOrder = self::createOrder($basket);
        return $currentOrder;
    }

    public static function createOrder($currentBasket)
    {
        $default_shiping_status = OrderShippingStatus::orderBy('default', 'DESC')->first();
        $order = Order::create([
            'user_id' => $currentBasket['user_id']
            , 'basket_id' => $currentBasket['id']
            , 'address_id' => @$currentBasket->address->id
            , 'city_id' => @$currentBasket->address->city_id
            , 'state_id' => @$currentBasket->address->state_id
            , 'address' => json_encode([
                'state' => @$currentBasket->address->state->name,
                'city' => @$currentBasket->address->city->name,
                'address' => @$currentBasket->address->address,
                'receiptor_mobile' => @$currentBasket->address->receiptor_mobile,
                'postal_code' => @$currentBasket->address->postal_code,
            ])
            , 'receiptor_full_name' => @$currentBasket->address->receiptor_full_name
            , 'shipping_method_id' => @$currentBasket['shipping_method_id']
            , 'bank_id' => @$currentBasket['bank_id']
            , 'order_status' => "paying"
            , 'discount_id' => @$currentBasket['discount_id']
            , 'shipping_price' => self::priceCalculate($currentBasket)['shipping_price']
            , 'total_price' => self::priceCalculate($currentBasket)['total_price']
            , 'discount_price' => self::priceCalculate($currentBasket)['discount_price']
            , 'payment_price' => self::priceCalculate($currentBasket)['payment_price']
            , 'shipping_status_id' => $default_shiping_status ? $default_shiping_status->id : null
        ]);
        $order->save();
        foreach ($currentBasket->items as $item) {
            OrderItem::create([
                'order_id' => $order->id
                , 'product_id' => @$item->product_id
                , 'product_variant_id' => @$item->product_variant_id
                , 'quantity' => @$item->quantity
                , 'price' => $item->product_variant_id ? $item->productVariant->price : $item->product->price
                , 'discounted_price' => $item->product_variant_id ?
                    (intval($item->productVariant->discounted_price) != 0 ? $item->productVariant->discounted_price : 0) :
                    (intval($item->product->discounted_price) != 0 ? $item->product->discounted_price : 0)
            ]);
        }
        $order->save();
        return $order;
    }

    //price calculator
    public static function priceCalculate($currentBasket)
    {
        $shipping_price = @$currentBasket->shippingMethod->price;
        $total_price = DiscountService::listPrice()['final_price_sum'];
        $discount_price = DiscountService::listPrice()['discount_amount'];
        $payment_price = DiscountService::listPrice()['price_cart'];
        return ['shipping_price' => $shipping_price, 'total_price' => $total_price, 'discount_price' => $discount_price,
            'payment_price' => $payment_price];

    }

    //checkout
    public static function checkOut($currentOrder)
    {

        $price = intval(str_replace(',', '', $currentOrder->payment_price));

        if ($currentOrder['discount_id'] != null && $price <= 0) {
            $currentOrder->update([
                'order_status' => "paid"
            ]);
            self::inventory($currentOrder);

            return redirect()->route('basket.success', ['id' => $currentOrder->id]);
        }
        $bank = Bank::findOrfail($currentOrder['bank_id']);

        if ($bank->bank_type == "zarinPal") {
            $merchant = json_decode(@$bank['config'], true)['MerchantId'];
            $price = intval(str_replace(',', '', $currentOrder->payment_price));
            $myBank = new ZarinPalClass();
            $check = $myBank->execute($merchant, $price);
            if ($check['status'] == "failed") {
                $currentOrder->delete();
                return redirect(route('basket.failed'))->with('error', 'خطا در پرداخت، مجدد تلاش نمایید.');
            } else {
                $transaction_info = [
                    'post' => [
                        "Authority" => $check["Authority"]
                    ],
                    'verify' => [
                        // مقدارهای داخل آرایه verify را اینجا وارد کنید
                    ]
                ];
                $currentOrder->update([
                    'transaction_info' => $transaction_info
                ]);
                header('Location: https://www.zarinpal.com/pg/StartPay/' . $check["Authority"]);
            }
        }

        if ($bank->bank_type == "sep") {

        }
        if ($bank->bank_type == "sadad") {

        }
    }


    public static function inventory($currentOrder)
    {
        foreach ($currentOrder->items as $item) {
            $resids = [
                'product_id' => @$item->product_id,
                'product_variant_id' => @$item->product_variant_id,
                'quantity' => @$item->quantity,
                'order_id' => $item->order_id,
                'type' => "add",

            ];
            self::setStockAndPrice($item);
        }
        InventoryTransaction::insert($resids);
    }

    public static function setStockAndPrice($item)
    {
        $product = Product::find(@$item->product_id);

        $product_variant_check = null;
        if ($item->product_variant_id != null) {

            $product_variant_check = ProductVariant::find($item->product_variant_id);
            $product_variant_check->update([
                'stock' => intval(@$product_variant_check->stock) - intval(@$item->quantity),
            ]);
            $product_variant_check->save();
            $sum_stock = $product->variants()->orderBy('final_price', 'ASC')->sum('stock');
            $minimum_price_variant = $product->variants()->where('price_affective', '1')->orderBy('final_price', 'ASC')->first();
            //Todo : اگر یک محصول با متغییر فقط یک موجودی داشته باشه این خط خطا میداد
//            $minimum_price_variant = $product->variants()->where('price_affective', '1')->orderBy('final_price', 'ASC')->where('stock', '<>', '0')->first();
            $product->update(
                [
                    'price' => $minimum_price_variant['price'],
                    'discounted_price' => $minimum_price_variant['discounted_price'],
                    'final_price' => $minimum_price_variant['final_price'],
                    'stock' => $sum_stock,
                ]
            );
        } else {
            $product->update([
                'stocks' => intval(@$product->stock) - intval(@$item->quantity),
            ]);
        }
        $product->save();
    }

    //finish
    public static function finish($currentOrder)
    {

        $price = intval(str_replace(',', '', $currentOrder->payment_price));
        $bank = Bank::findOrfail($currentOrder['bank_id']);

        if ($bank->bank_type == "zarinPal") {
            $merchant = json_decode(@$bank['config'], true)['MerchantId'];
            $myBank = new ZarinPalClass();
            $authority = json_decode(@$currentOrder->transaction_info, true)['post']['Authority'];
            $check = $myBank->finish($merchant, $authority, $price);
            Auth::loginUsingId($currentOrder->user_id);
            if ($check['status'] == "failed") {
                $currentOrder->delete();
                return redirect(route('basket.failed'))->with('error', 'خطا در پرداخت، مجدد تلاش نمایید.');
            } else {
                $transaction_info = [
                    'post' => [
                        "Authority" => $authority
                    ],
                    'verify' => [
                        "RefID" => $check["RefID"]
                    ]
                ];
                $currentOrder->update([
                    'transaction_info' => $transaction_info,
                    'order_status' => "paid"
                ]);
                if ($check['inventory'] === true) {
                    self::inventory($currentOrder);
                }
                if (Auth::user()->mobile) {
                    $kavenegar = new Sms();
                    $kavenegar->sendLookup(
                        "userBuy",
                        [
                            "token" => "$currentOrder->id",
                        ],
                        Auth::user()->mobile
                    );
                }

                $admin_mobile = Setting::where('key', 'admin_mobile')->whereNotNull('value')->first();
                if ($admin_mobile) {
                    $kavenegar = new Sms();
                    $kavenegar->sendLookup(
                        "adminBuy",
                        [
                            "token" => "$currentOrder->id",

                        ],
                        $admin_mobile->value
                    );
                }


                return redirect(route('basket.success', ['id' => $currentOrder->id]));

            }
        }

        if ($bank->bank_type == "sep") {

        }
        if ($bank->bank_type == "sadad") {

        }
    }


}
