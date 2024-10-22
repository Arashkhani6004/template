<?php

namespace Rahweb\CmsCore\Modules\Order\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\General\Helper\Sms;
use Rahweb\CmsCore\Modules\Location\Entities\City;
use Rahweb\CmsCore\Modules\Order\DTO\ShippingMethodDTO;
use Rahweb\CmsCore\Modules\Order\Entities\Order;
use Rahweb\CmsCore\Modules\Order\Entities\OrderShippingStatus;
use Rahweb\CmsCore\Modules\Order\Entities\ShippingMethod;
use Rahweb\CmsCore\Modules\Order\Filters\OrderFilter;
use Rahweb\CmsCore\Modules\Order\Http\Requests\ShippingMethodRequest;
use Rahweb\CmsCore\Modules\Order\Services\ShippingMethodService;
use Rahweb\CmsCore\Modules\Setting\Entities\Setting;
use Rahweb\CmsCore\Modules\Setting\Services\SettingService;

class OrderController extends Controller
{
    protected $shippingMethodService;
    public function __construct(ShippingMethodService $shippingMethodService)
    {
        $this->shippingMethodService = $shippingMethodService;
    }
    /**
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $query = Order::query();
        $shipping_methods = ShippingMethod::orderBy('id','DESC')->get();
        $shipping_statuses = OrderShippingStatus::orderBy('id','DESC')->get();
        if ($request->has(['filter'])) {
            $filters = [
                'full_name' => $request->input('full_name'),
                'shipping_method_id' => $request->input('shipping_method_id'),
                'shipping_status_id' => $request->input('shipping_status_id'),
                'order_status' => $request->input('order_status'),
                'user_id' => $request->input('user_id'),
                'id' => $request->input('id'),
                'mobile' => $request->input('mobile'),
            ];
            $query = app(OrderFilter::class)->apply($query, $filters);
        }
        $orders= $query->orderBy('id','DESC')->paginate(20);
        return view('CmsCore::order.order.index', compact('orders','shipping_statuses','shipping_methods'));

    }
    public function detail(int $id)
    {
        $data = Order::findOrfail($id);
        $shipping_statuses = OrderShippingStatus::orderBy('id','DESC')->get();

        return view('CmsCore::order.order.detail', compact('data','shipping_statuses'));

    }
    public function factor($id)
    {
        $order = Order::findOrfail($id);
        $settings = SettingService::getFormatSettings(['siteName_fa','logo','main_phone_number']);
        return view('CmsCore::order.order.factor', compact('order','settings'));

    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function changeShippingStatus(Request $request, $id)
    {
        $data = Order::findOrfail($id);
        if ($data['shipping_status_id'] != $request->get('shipping_status_id')){
            $status_title =@$data->shipping_status->title;
            $data->update(
                [
                    'shipping_status_id'=>$request->get('shipping_status_id')
                ]
            );
            $kavenegar = new Sms();

            $kavenegar->sendLookup(
                "userChangeStatus",
                [
                    "token"=>"$data->id",
                    "token10"=>"$status_title",
                ],
                $data->user->mobile
            );



        }


        return redirect()->route('admin.order.index')
            ->with('success', 'وضعیت ویرایش شد.');

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ShippingMethodRequest $request, $id)
    {
        $this->shippingMethodService->update($id, ShippingMethodDTO::fromRequest($request));
        return redirect()->route('admin.order.index')
            ->with('success', 'وضعیت ویرایش شد.');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->shippingMethodService->deleteOne($id);
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }

}
