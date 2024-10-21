<?php

namespace Rahweb\CmsCore\Modules\Product\Http\Controllers;

use Rahweb\CmsCore\Modules\General\Helper\CacheHelper;
use Rahweb\CmsCore\Modules\Blog\DTO\BlogCategoryDTO;
use Rahweb\CmsCore\Modules\Blog\Entities\BlogCategory;
use Rahweb\CmsCore\Modules\Blog\Filters\BlogCategoryFilter;
use Rahweb\CmsCore\Modules\Blog\Http\Requests\BlogCategoryRequest;
use Rahweb\CmsCore\Modules\Blog\Services\BlogCategoryService;
use Rahweb\CmsCore\Modules\Product\DTO\ProductCategoryDTO;
use Rahweb\CmsCore\Modules\Product\Entities\ProductCategory;
use Rahweb\CmsCore\Modules\Product\Filters\ProductCategoryFilter;
use Rahweb\CmsCore\Modules\Product\Http\Requests\ProductCategoryRequest;
use Rahweb\CmsCore\Modules\Product\Services\ProductCategoryService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;

class ProductCategoryController extends Controller
{
    protected $productCategoryService;
    public function __construct(ProductCategoryService $productCategoryService)
    {
        $this->productCategoryService = $productCategoryService;
    }
    /**
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $query = ProductCategory::query();
        if ($request->has(['title', 'parent_id'])) {
            $filters = [
                'title' => $request->input('title'),
                'parent_id' => $request->input('parent_id'),
            ];
            $query = app(ProductCategoryFilter::class)->apply($query, $filters);
        }
        $product_category = $query->get();
        $product_category = $this->productCategoryService->formatProductCategories($product_category, 15);
        return view('CmsCore::product.product-category.index', compact('product_category'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $product_categories = $this->productCategoryService->findAll();
        return view('CmsCore::product.product-category.create',compact('product_categories'));

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ProductCategoryRequest $request)
    {

        $this->productCategoryService->create(ProductCategoryDTO::fromRequest($request));
        CacheHelper::clearCache();
        return redirect()->route('admin.product-category.index')
            ->with('success', 'دسته بندی محصول جدید اضافه شد.');
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(int $id)
    {
        $data = ProductCategory::findOrfail($id);
        $product_categories = $this->productCategoryService->findAll($id);
        return view('CmsCore::product.product-category.edit', compact('data','product_categories'));

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ProductCategoryRequest $request, $id)
    {
        $this->productCategoryService->update($id, ProductCategoryDTO::fromRequest($request));
        CacheHelper::clearCache();
        return redirect()->route('admin.product-category.index')
            ->with('success', 'دسته بندی محصول ویرایش شد.');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->productCategoryService->deleteOne($id);
        CacheHelper::clearCache();
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }

    public function deleteRoot($id)
    {
        $this->productCategoryService->deleteRoot($id);
        CacheHelper::clearCache();
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }
}
