<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Rahweb\CmsCore\Modules\General\Helper\NumberHelper;
use Rahweb\CmsCore\Modules\Location\Entities\Address;
use Rahweb\CmsCore\Modules\Location\Entities\City;
use Rahweb\CmsCore\Modules\Location\Entities\State;
use Rahweb\CmsCore\Modules\Location\Http\Resources\AddressCollection;
use Rahweb\CmsCore\Modules\Location\Services\AddressService;
use Rahweb\CmsCore\Modules\Location\Services\CityService;
use Rahweb\CmsCore\Modules\Location\Services\StateService;
use Rahweb\CmsCore\Modules\Order\Http\Resources\BasketCollection;
use Rahweb\CmsCore\Modules\Order\Services\BasketService;
use Rahweb\CmsCore\Modules\Product\Entities\Product;


class AddressController extends Controller
{
    //list
    public function list()
    {
        $basket = BasketService::findBasketAndCheckStock();
        if (!$basket){
            return redirect(
                route('basket.cart')
            );
        }
        return view(
            'pages.cart.address', compact('basket'));

    }
    public function userAddresses()
    {
        $addresses = AddressService::find();
        $addressCollection = new AddressCollection($addresses['addresses']);
        return response()->json([
            'addresses' => @$addressCollection,
        ], 200);
    }
    public function states()
    {
        $states = StateService::findAll();
        return response()->json(['states' => $states]);
    }
    public function city(Request $request)
    {
        $req = $request->all();
        $cities = null;
        $cities = CityService::findOne($req['state_id']);

        return response()->json(['cities' => $cities]);
    }
    public function create(Request $request)
    {
        $user_id = @Auth::id();
        $state_id = @$request->get('state_id');
        $city_id = @$request->get('city_id');
        $address = @$request->get('address');
        $postal_code = NumberHelper::persian2LatinDigit(@$request->get('postal_code'));
        $receiptor_full_name = @$request->get('receiptor_full_name');
        $receiptor_mobile = NumberHelper::persian2LatinDigit(@$request->get('receiptor_mobile'));
       AddressService::create($user_id, $state_id, $city_id, $address, $postal_code, $receiptor_full_name, $receiptor_mobile);
        return redirect()->back()->with('success', 'آدرس با موفقیت اضافه شد');

    }
    public function edit(Request  $request)
    {
        $address = AddressService::findOne($request->get('address_id'));
        return response()->json(['address' => $address]);

    }
    public function update(Request $request)
    {
        $user_id = @Auth::id();
        $address_id = @$request->get('address_id');
        $state_id = @$request->get('state_id');
        $city_id = @$request->get('city_id');
        $address = @$request->get('address');
        $postal_code = NumberHelper::persian2LatinDigit(@$request->get('postal_code'));
        $receiptor_full_name = @$request->get('receiptor_full_name');
        $receiptor_mobile = NumberHelper::persian2LatinDigit(@$request->get('receiptor_mobile'));
        AddressService::update($address_id,$user_id, $state_id, $city_id, $address, $postal_code, $receiptor_full_name, $receiptor_mobile);
        return redirect()->back()->with('success', 'آدرس با موفقیت ویرایش شد');

    }
    public function shipments(Request $request)
    {
        $address = AddressService::findOne($request->get('address_id'));
        $basket = BasketService::findBasketAndCheckStock();
        $basket->update([
           'address_id' =>@$request->get('address_id')
        ]);
        return response()->json(['shipping_methods' => @$address->city->shippingMethods]);


    }
    public function setShipments(Request $request)
    {
        $basket = BasketService::findBasketAndCheckStock();
        $basket->update([
            'shipping_method_id' =>@$request->get('shipping_method_id')
        ]);


    }
    //price
    public function addressPrice(){
        $price = BasketService::addressPrice();
        return response()->json($price);
    }


}
