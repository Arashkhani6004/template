<?php

namespace App\Http\Controllers;

use App\Library\Assistant\Modules\V1\Contact;
use App\Library\Assistant\Modules\V1\Seo;
use App\Library\SiteHelper;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;

//Todo: ای پی آی جداگلنه از تنظیمات
class UsController extends Controller
{
    public function about()
    {
        $seo = Seo::getStatic(implode('/', request()->segments()));
        return view('pages.about-us.index');
    }
    public function contact()
    {
        return view('pages.contact-us.index');
    }
    public function postContact(Request $request)
    {
        $data = Contact::create($request->all());
        if ($data['success'] == "true") {
            return Redirect::back()->with('success', 'پیام شما با موفقیت ثبت شد');
        } else {
            return Redirect::back()->with('error', 'مشکلی پیش آمده است لطفا مجدد تلاش کنید');

        }
    }
    public function flushCache()
    {
        Cache::flush();
        return redirect()->to('/')->with('success', 'کش با موفقیت پاک شد');
    }
}
