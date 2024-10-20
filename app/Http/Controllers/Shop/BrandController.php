<?php

namespace App\Http\Controllers\Shop;

use App\Library\Assistant\Modules\V1\Shop;
use App\Modules\Product\Http\Resources\BrandCollection;
use App\Modules\Product\Http\Resources\ProductCollection;
use App\Modules\Product\Http\Resources\SpecificationCollection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Rahweb\CmsCore\Modules\Product\Services\BrandService;
use Rahweb\CmsCore\Modules\Product\Services\ProductCategoryService;
use Rahweb\CmsCore\Modules\Product\Services\ProductService;
use Rahweb\CmsCore\Modules\Product\Services\SpecificationService;

class BrandController extends Controller
{
    public function list(Request $request)
    {
        $brands = BrandService::findAll(['title'=>$request->get('title')], false);
        return view('pages.brand-list.index', compact('brands'));
    }

    public function detail($url)
    {
        $brand = BrandService::findOne($url);
        $brands = BrandService::findAll([], $brand['id']);

        $query = ['brand' => $brand['id']];
        $products = ProductService::findAll($query, null, 12);
        $product_price = ProductService::findAll($query)->load('categories');
        $min_price = collect($product_price)->min('final_price');
        $max_price = collect($product_price)->max('final_price');

        //categories
        $category_ids = $product_price->pluck('categories.*.id')->flatten()->unique()->toArray();
        $query_category = ['filter_categories' => $category_ids];
        $categories = ProductCategoryService::findAll($query_category, false);

        //specifications
        $query_filter = ['categories' => $category_ids, 'is_filter' => true];
        $filters = SpecificationService::findAll($query_filter);

        $min_filter_price = \request()->priceRange ? intval(explode('_', \request()->priceRange)[0]) : $min_price;
        $max_filter_price = \request()->priceRange ? intval(explode('_', \request()->priceRange)[1]) : $max_price;
        return view('pages.brand-detail.index', compact(['brand', 'categories',
            'products', 'brands', 'filters', 'max_price', 'min_price', 'max_filter_price', 'min_filter_price']));
    }

}
