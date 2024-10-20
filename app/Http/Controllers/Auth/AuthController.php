<?php

namespace App\Http\Controllers\Auth;

use App\Library\Assistant\Modules\V1\Contact;
use App\Library\Assistant\Modules\V1\Seo;
use App\Library\SiteHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\General\Helper\Sms;
use Rahweb\CmsCore\Modules\Order\Entities\Basket;
use Rahweb\CmsCore\Modules\Order\Services\BankService;
use Rahweb\CmsCore\Modules\Order\Services\BasketService;
use Rahweb\CmsCore\Modules\User\Entities\User;
use Rahweb\CmsCore\Modules\User\Services\UserService;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }
    public function login(Request $request)
    {
        $input = $request->only('name', 'mobile','url');
        $mobile = $input['mobile'];
        if (!strlen($mobile)) {
            return back()->with(["error" => "لطفا شماره موبایل رو وارد کنید"]);
        }
        $user = UserService::findByMobile($mobile);
        $code = rand(1000, 9999);
        if (!$user) {
            if(!strlen($input['name'])){
                return back()->with(["error" => "نام و نام خانوادگی الزامیست"]);
            }
            $user = UserService::createFromSite($request);

        }


        $user->update(['confirm_code' => $code]);
        $kavenegar = new Sms();
        $result =$kavenegar->sendLookup(
            "verify",
            [
                "token"=>$code,
            ],
            $user->mobile
        );
        if ($result instanceof RedirectResponse) {
            return $result;
        }

        return redirect(route("auth.mobile-code", [
            'mobile' => $mobile,
            'url' => \request()->get("url")
        ]));

    }
    public function checkUserExisting(Request $request)
    {
        $user = UserService::findByMobile($request->mobile);
        if ($user) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    public function getCode()
    {
        return view('pages.auth.confirm-code');
    }

    public function postCode()
    {
        $mobile = \request()->get("mobile");
        $code = \request()->get("code");
        $user = UserService::findByMobileAndCode($mobile,$code);
        if ($user) {
            Auth::loginUsingId($user->id);
            if (\request()->get("url")) {
                $url = url(\request()->get("url"));
            } else {
                $url = url('/panel/dashboard');
            }
            BasketService::findUserBasketAndUpdateBaskets();
            return redirect($url)->with('success', "ورود با موفقیت انجام شد");
        }
        return back()->with("error", "کد نادرست است");
    }

    public function logout()
    {
        Auth::logout();
        return redirect("/")->with('success', 'خوش آمدید, منتظر ورود دوباره شماییم!');
    }



}
