<?php

namespace Rahweb\CmsCore\Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\Product\DTO\BrandDTO;
use Rahweb\CmsCore\Modules\Product\Entities\Brand;
use Rahweb\CmsCore\Modules\Product\Filters\BrandFilter;
use Rahweb\CmsCore\Modules\Product\Http\Requests\BrandRequest;
use Rahweb\CmsCore\Modules\Product\Services\BrandService;

class BrandController extends Controller
{
    protected $brandService;
    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }
    /**
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $query = Brand::query();
        if ($request->has(['title'])) {
            $filters = [
                'title' => $request->input('title'),
            ];
            $query = app(BrandFilter::class)->apply($query, $filters);
        }
        $brands = $query->paginate(20);
        return view('CmsCore::product.brand.index', compact('brands'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $brands = $this->brandService->findAll();
        return view('CmsCore::product.brand.create', compact('brands'));

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(BrandRequest $request)
    {

        $this->brandService->create(BrandDTO::fromRequest($request));
        return redirect()->route('admin.brand.index')
            ->with('success', 'برند محصول جدید اضافه شد.');
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(int $id)
    {
        $data = Brand::findOrfail($id);
        return view('CmsCore::product.brand.edit', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(BrandRequest $request, $id)
    {
        $this->brandService->update($id, BrandDTO::fromRequest($request));
        return redirect()->route('admin.brand.index')
            ->with('success', 'برند محصول ویرایش شد.');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->brandService->deleteOne($id);
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }

}
