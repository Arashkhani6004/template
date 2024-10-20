<?php

namespace App\Http\Controllers\Panel;

use App\Library\Assistant\Modules\V1\Contact;
use App\Library\Assistant\Modules\V1\Seo;
use App\Library\NumberHelper;
use App\Library\SiteHelper;
use App\Library\YearHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\General\Helper\Sms;
use Rahweb\CmsCore\Modules\Location\Entities\Address;
use Rahweb\CmsCore\Modules\Location\Entities\City;
use Rahweb\CmsCore\Modules\Location\Entities\State;
use Rahweb\CmsCore\Modules\Location\Http\Resources\AddressCollection;
use Rahweb\CmsCore\Modules\Location\Services\AddressService;
use Rahweb\CmsCore\Modules\Location\Services\CityService;
use Rahweb\CmsCore\Modules\Location\Services\StateService;
use Rahweb\CmsCore\Modules\User\Entities\User;

class AddressController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pages.panel.addresses.index',compact('user'));
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
        $postal_code = \Rahweb\CmsCore\Modules\General\Helper\NumberHelper::persian2LatinDigit(@$request->get('postal_code'));
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

}
