<?php

namespace Rahweb\CmsCore\Modules\Order\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\Order\DTO\DiscountDTO;
use Rahweb\CmsCore\Modules\Order\Entities\Discount;
use Rahweb\CmsCore\Modules\Order\Filters\DiscountFilter;
use Rahweb\CmsCore\Modules\Order\Http\Requests\DiscountRequest;
use Rahweb\CmsCore\Modules\Order\Services\DiscountService;
use Rahweb\CmsCore\Modules\User\Entities\User;

class DiscountController extends Controller
{
    protected $discountService;
    public function __construct(DiscountService $discountService)
    {
        $this->discountService = $discountService;
    }
    /**
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $query = Discount::query();
        if ($request->has(['filter'])) {
            $filters = [
                'title' => $request->input('title'),
                'user_id' => $request->input('user_id'),
            ];
            $query = app(DiscountFilter::class)->apply($query, $filters);
        }
        $discounts= $query->paginate(20);
        return view('CmsCore::order.discount.index', compact('discounts'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $user = User::all();
        return view('CmsCore::order.discount.create', compact('user'));

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(DiscountRequest $request)
    {

        $this->discountService->create(DiscountDTO::fromRequest($request));
        return redirect()->route('admin.discount.index')
            ->with('success', 'روش ارسال جدید اضافه شد.');
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(int $id)
    {
        $data = Discount::findOrfail($id);
        $user = User::all();

        return view('CmsCore::order.discount.edit', compact('data','user'));

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(DiscountRequest $request, $id)
    {
        $this->discountService->update($id, DiscountDTO::fromRequest($request));
        return redirect()->route('admin.discount.index')
            ->with('success', 'روش ارسال ویرایش شد.');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->discountService->deleteOne($id);
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }

}
