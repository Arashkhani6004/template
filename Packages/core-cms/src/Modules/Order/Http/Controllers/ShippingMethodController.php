<?php

namespace Rahweb\CmsCore\Modules\Order\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\Location\Entities\City;
use Rahweb\CmsCore\Modules\Order\DTO\ShippingMethodDTO;
use Rahweb\CmsCore\Modules\Order\Entities\ShippingMethod;
use Rahweb\CmsCore\Modules\Order\Filters\ShippingMethodFilter;
use Rahweb\CmsCore\Modules\Order\Http\Requests\ShippingMethodRequest;
use Rahweb\CmsCore\Modules\Order\Services\ShippingMethodService;

class ShippingMethodController extends Controller
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
        $query = ShippingMethod::query();
        if ($request->has(['title'])) {
            $filters = [
                'title' => $request->input('title'),
            ];
            $query = app(ShippingMethodFilter::class)->apply($query, $filters);
        }
        $methods= $query->paginate(20);
        return view('CmsCore::order.shipping-method.index', compact('methods'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $cities = City::all();
        return view('CmsCore::order.shipping-method.create', compact('cities'));

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ShippingMethodRequest $request)
    {

        $this->shippingMethodService->create(ShippingMethodDTO::fromRequest($request));
        return redirect()->route('admin.shipping-method.index')
            ->with('success', 'روش ارسال جدید اضافه شد.');
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(int $id)
    {
        $data = ShippingMethod::findOrfail($id);
        $cities = City::all();

        return view('CmsCore::order.shipping-method.edit', compact('data','cities'));

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
        return redirect()->route('admin.shipping-method.index')
            ->with('success', 'روش ارسال ویرایش شد.');

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
