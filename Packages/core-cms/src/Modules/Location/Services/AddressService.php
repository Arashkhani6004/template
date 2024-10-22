<?php

namespace Rahweb\CmsCore\Modules\Location\Services;

use Illuminate\Support\Facades\Auth;
use Rahweb\CmsCore\Modules\Location\Entities\Address;
use Rahweb\CmsCore\Modules\Order\Entities\Basket;
use Rahweb\CmsCore\Modules\Order\Entities\BasketItem;
use Rahweb\CmsCore\Modules\Product\Entities\Product;
use Rahweb\CmsCore\Modules\Product\Entities\ProductVariant;


class AddressService
{

    public static function find()
    {
        $addresses = null;
        $addresses =  Address::orderby('id', 'DESC')->authUser()->with(['city', 'state'])->get();
        return [
            'addresses'=>$addresses,
        ];
    }
    public static function findOne($address_id)
    {
      return Address::findOrFail($address_id);
    }

    public static function create($user_id, $state_id, $city_id, $address, $postal_code, $receiptor_full_name, $receiptor_mobile){
        Address::create([
            'user_id' => $user_id,
            'state_id' => $state_id,
            'city_id' => $city_id,
            'address' => $address,
            'postal_code' =>$postal_code ,
            'receiptor_full_name' => $receiptor_full_name,
            'receiptor_mobile' => $receiptor_mobile
        ]);
        return response()->json([
            'message' => 'آدرس با موفقیت اضافه شد.',
        ], 200);
    }
    public static function update($address_id,$user_id, $state_id, $city_id, $address, $postal_code, $receiptor_full_name, $receiptor_mobile){
        $location = Address::findOrFail($address_id);
        $location->update([
            'user_id' => $user_id,
            'state_id' => $state_id,
            'city_id' => $city_id,
            'address' => $address,
            'postal_code' =>$postal_code ,
            'receiptor_full_name' => $receiptor_full_name,
            'receiptor_mobile' => $receiptor_mobile
        ]);

        return response()->json([
            'message' => 'آدرس با موفقیت ویرایش شد.',
        ], 200);
    }


    public static function listPrice()
    {
        $basket = Basket::authUser()->orderBy('id', 'DESC')->first();
        $final_price_sum = 0;
        $price_sum = 0;
        foreach ($basket->items as $item){
            $final_price = $item->product_variant_id ? $item->productVariant->final_price : $item->product->final_price;
            $final_price_quantity = $final_price * $item->quantity;
            $price = $item->product_variant_id ?
                (intval($item->productVariant->discounted_price) != 0 ?  $item->productVariant->price : 0) :
                (intval($item->product->discounted_price) != 0 ?  $item->product->price : 0);
            $price_quantity = $price * $item->quantity;
            $final_price_sum += $final_price_quantity;
            $price_sum += $price_quantity;
        }
        $price_discount = $price_sum - $final_price_sum;
        return ['final_price_sum'=>$final_price_sum , 'price_sum'=>$price_sum ,'price_discount'=> $price_discount];
    }


}
