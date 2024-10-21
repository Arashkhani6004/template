<?php

namespace Rahweb\CmsCore\Modules\User\Http\Controllers;

use Rahweb\CmsCore\Modules\General\Helper\RahwebSms;
use Rahweb\CmsCore\Modules\General\Helper\SiteHelper;
use Rahweb\CmsCore\Modules\User\Entities\User;
use Rahweb\CmsCore\Modules\User\Entities\UserType;
use Illuminate\Routing\Controller;

use Rahweb\CmsCore\Modules\General\Helper\NumberHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function login()
    {
        return view('CmsCore::user.auth.admin.login');
    }

    public function postLogin(Request $request)
    {
        $input = $request->all();
        $check = Auth::attempt([
            'email' => $input['email'],
            'password' => NumberHelper::persian2LatinDigit($input['password']),
            'deleted_at' => null
        ]);

        if ($check) {
            return redirect('/admin')->with('success', 'خوش آمدید.');
        } else {
            return redirect('/admin/login')->with('error', 'ایمیل یا رمزعبور صحیح نیست.');
        }
    }

    public function logout()
    {
        Session::flush();

        Auth::logout();

        return redirect('admin/login')->with('success', 'خوش آمدید.منتظر ورود دوباره شماییم!');
    }

    public function dashboard()
    {

        return view('CmsCore::admin.dashboard');

    }

    public function changePassword(Request $request)
    {
        $site = SiteHelper::getInformation();
        $response = Http::withoutVerifying()->get("https://www.rahweb.com/owner-site-mobile/".$site["template_url"]);
        if (in_array($response->status(), [404, 500])) {
            return redirect('/admin/login')
                ->with('error', 'خطایی در ارسال رمز عبور جدید رخ داد. لطفا این مشکل را در تیکت ارسال کنید.');
        }

        $userType = UserType::orderBy('id', 'ASC')->where('type', 'Admin')->firstOrFail();
        $user = User::where('id', $userType->user_id)->firstOrFail();
        $code = random_int(1000000, 9999999);
        $user->password = bcrypt($code);
        $user->save();

        $Sms = new RahwebSms();
        $response = $Sms->sendSms("اطلاعات ورود : \n ایمیل : $user->email \n رمز عبور : $code", $response->json()['mobile']);
        \Log::info($response);
        if ($response["success"] == false) {
            return redirect('/admin/login')->with('error', 'خطایی در ارسال رمز عبور جدید رخ داد');
        } else {
            return redirect('/admin/login')->with('success', 'رمز عبور جدید برای ادمین اصلی پیامک شد');
        }
    }
}
