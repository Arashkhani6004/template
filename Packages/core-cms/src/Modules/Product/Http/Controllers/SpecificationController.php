<?php

namespace Rahweb\CmsCore\Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\Product\DTO\SpecificationDTO;
use Rahweb\CmsCore\Modules\Product\Entities\ProductCategory;
use Rahweb\CmsCore\Modules\Product\Entities\Specification;
use Rahweb\CmsCore\Modules\Product\Filters\SpecificationFilter;
use Rahweb\CmsCore\Modules\Product\Http\Requests\SpecificationRequest;
use Rahweb\CmsCore\Modules\Product\Services\ProductCategoryService;
use Rahweb\CmsCore\Modules\Product\Services\SpecificationService;

class SpecificationController extends Controller
{
    protected $specificationService;
    public function __construct(SpecificationService $specificationService,
        ProductCategoryService $productCategoryService
    ) {
        $this->specificationService = $specificationService;
        $this->productCategoryService = $productCategoryService;

    }
    /**
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $query = Specification::query()->whereNull('parent_id');
        if ($request->has(['title'])) {
            $filters = [
                'title' => $request->input('title'),
            ];
            $query = app(SpecificationFilter::class)->apply($query, $filters);
        }
        $specification = $query->paginate(20);
        return view('CmsCore::product.specification.index', compact('specification'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories = ProductCategory::doesntHave('children')->get();

        return view('CmsCore::product.specification.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(SpecificationRequest $request)
    {

        $this->specificationService->create(SpecificationDTO::fromRequest($request));
        return redirect()->route('admin.specification.index')
            ->with('success', 'آیتم جدید اضافه شد.');
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(int $id)
    {
        $data = Specification::findOrfail($id);
        $categories = ProductCategory::doesntHave('children')->get();
        return view('CmsCore::product.specification.edit', compact('data', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(SpecificationRequest $request, $id)
    {

        $this->specificationService->update($id, SpecificationDTO::fromRequest($request));
        return redirect()->route('admin.specification.index')
            ->with('success', 'آیتم ویرایش شد.');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->specificationService->deleteOne($id);
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }

}
