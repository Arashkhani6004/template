<?php

namespace Rahweb\CmsCore\Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\General\Helper\MakeTree;
use Rahweb\CmsCore\Modules\Product\DTO\ProductDTO;
use Rahweb\CmsCore\Modules\Product\DTO\TimerDTO;
use Rahweb\CmsCore\Modules\Product\Entities\Brand;
use Rahweb\CmsCore\Modules\Product\Entities\Product;
use Rahweb\CmsCore\Modules\Product\Entities\ProductCategory;
use Rahweb\CmsCore\Modules\Product\Filters\ProductFilter;
use Rahweb\CmsCore\Modules\Product\Http\Requests\ProductRequest;
use Rahweb\CmsCore\Modules\Product\Http\Requests\TimerRequest;
use Rahweb\CmsCore\Modules\Product\Services\ProductService;
use Rahweb\CmsCore\Modules\Tag\Entities\Tag;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $query = Product::query();
        if ($request->has(['title', 'parent_id'])) {
            $filters = [
                'title' => $request->input('title'),
                'brand_id' => $request->input('brand_id'),
            ];
            $query = app(ProductFilter::class)->apply($query, $filters);
        }
        $product = $query->orderby('id', 'DESC')->paginate(20);
        $brand = Brand::orderby('id', 'DESC')->get();
        return view('CmsCore::product.product.index', compact('product', 'brand'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $brand = Brand::orderby('id', 'DESC')->get();
        $categories = ProductCategory::orderBy('id', 'DESC')->select(['title', 'id', 'parent_id'])->get();
        if (!empty($categories)) {
            MakeTree::getData($categories);
            $categories = MakeTree::GenerateArray(['get']);
        }
        $products = Product::orderByDesc('id')->get();
        $tags = Tag::all();
        return view('CmsCore::product.product.create',
            compact('brand', 'categories', 'products', 'tags'));

    }

    public function store(ProductRequest $request)
    {
        $this->productService->create(ProductDTO::fromRequest($request));
        return redirect()->route('admin.product.index')
            ->with('success', ' محصول جدید اضافه شد.');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data = Product::findOrfail($id);
        $brand = Brand::orderby('id', 'DESC')->get();
        $categories = ProductCategory::orderBy('id', 'DESC')->select(['title', 'id', 'parent_id'])->get();
        if (!empty($categories)) {
            MakeTree::getData($categories);
            $categories = MakeTree::GenerateArray(['get']);
        }
        $selected_categories = $data->categories;
        $products = Product::orderByDesc('id')->where('id', '<>', $id)->get();
        $tags = Tag::all();
        return view('CmsCore::product.product.edit',
            compact('categories', 'data', 'brand', 'selected_categories', 'products', 'tags'));

    }

    public function update(ProductRequest $request, $id)
    {
        $this->productService->update($id, ProductDTO::fromRequest($request));
        return redirect()->route('admin.product.index')
            ->with('success', 'محصول ویرایش شد.');
    }

    public function destroy($id)
    {
        $this->productService->destroy($id);
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }

    public function timer(TimerRequest $request)
    {
        $this->productService->timer(TimerDTO::fromRequest($request));
        return Redirect::back()->with('success', 'تایمر موردنظر با موفقیت ویرایش شد');
    }
}
