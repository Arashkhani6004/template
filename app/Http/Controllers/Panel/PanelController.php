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
use Rahweb\CmsCore\Modules\User\Entities\User;

class PanelController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        return view('pages.panel.dashboard.index',compact('user'));
    }
    public function profile()
    {
        $year = intval(NumberHelper::persian2LatinDigit(jdate('Y',Carbon::now()->timestamp)));
        $last = $year;
        $first = $year - 100;
        $years = YearHelper::generateNumbersBetween($first,$last);
        $months = [
            '01' => ['name' => 'فروردین', 'max' => '31'],
            '02' => ['name' => 'اردیبهشت', 'max' => '31'],
            '03' => ['name' => 'خرداد', 'max' => '31'],
            '04' => ['name' => 'تیر', 'max' => '31'],
            '05' => ['name' => 'مرداد', 'max' => '31'],
            '06' => ['name' => 'شهریور', 'max' => '31'],
            '07' => ['name' => 'مهر', 'max' => '30'],
            '08' => ['name' => 'آبان', 'max' => '30'],
            '09' => ['name' => 'آذر', 'max' => '30'],
            '10' => ['name' => 'دی', 'max' => '30'],
            '11' => ['name' => 'بهمن', 'max' => '30'],
            '12' => ['name' => 'اسفند', 'max' => '29'],
        ];
        return view('pages.panel.edit-information.index',compact('years','months'));
    }
    public function editProfile(Request $request){
        $input = $request->all();
        $input['mobile'] = NumberHelper::persian2LatinDigit($input['mobile']);
        $user= Auth::user();
        $check_mobile= Auth::user()->mobile;
        if (@$input['month']){
            $s = jmktime(0, 0, 0, $input['month'], $input['day'], $input['year']);

            $input['birthday'] =Carbon::createFromTimestamp($s);
            $formattedDateTime = Carbon::now()->format('Y-m-d');
            if($input['birthday']->format('Y-m-d') > $formattedDateTime){
                return Redirect::back()
                    ->with('error', 'تاریخ تولد نمی تواند بزرگتر از امروز باشد');
            }
        }
        $user->update($input);
        if ($check_mobile != $input['mobile']){
            Auth::logout();
            return redirect(route('auth.index'))->with('success', 'لطفا با شماره تلفن جدید خود وارد شوید!');
        }
        return Redirect::back()
            ->with('success', 'با موفقیت ویرایش شد');
    }

}
