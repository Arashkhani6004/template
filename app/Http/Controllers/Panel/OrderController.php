<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Rahweb\CmsCore\Modules\Order\Entities\Order;
use Rahweb\CmsCore\Modules\Order\Services\OrderService;
use Rahweb\CmsCore\Modules\Setting\Entities\Setting;
use Rahweb\CmsCore\Modules\Setting\Services\SettingService;

class OrderController extends Controller
{
    public function index()
    {
        $user= Auth::user();
        return view('pages.panel.order.list',compact('user'));
    }
    public function detail($id){
        $order = OrderService::findById($id);
        return view('pages.panel.order.detail',compact('order'));
    }
    public function factor($id){
        $order = OrderService::findById($id);
        $settings = SettingService::getFormatSettings(['siteName_fa','logo','main_phone_number']);
        return view('pages.panel.order.factor',compact('order','settings'));
    }

}
