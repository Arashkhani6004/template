<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Routing\Controller;
use Rahweb\CmsCore\Modules\Product\Services\BrandService;
use Rahweb\CmsCore\Modules\Product\Services\ProductCategoryService;
use Rahweb\CmsCore\Modules\Product\Services\ProductService;
use Rahweb\CmsCore\Modules\Product\Services\SpecificationService;

class CategoryController extends Controller
{
    public function list()
    {
        $query_category = ['list' => true];
        $product_categories = ProductCategoryService::findAll($query_category, false);
        return view('pages.category-product.index', compact('product_categories'));
    }

    public function detail($url)
    {
        $product_category = ProductCategoryService::findOne($url);
        $children = $product_category->children;

        //products
        $category_ids = [];
        $category_ids[] = $product_category->id;
        foreach ($product_category->children as $row) {
            $category_ids[] = $row['id'];
            if (count($row->children) > 0) {
                foreach ($row->children as $child) {
                    $category_ids[] = $child['id'];
                }
            }
        }

        $query = ['categories' => $category_ids];
        $products = ProductService::findAll($query, null, 12);
        $product_price = ProductService::findAll($query);
        $min_price = intval(collect($product_price)->min('final_price'));
        $max_price = intval(collect($product_price)->max('final_price'));

        //brands
        $brand_ids = ProductService::findAll($query)->pluck('brand_id');
        $query_brand = ['filter_brands' => $brand_ids];
        $brands = BrandService::findAll($query_brand);

        //specifications
        $query_filter = ['categories' => $category_ids, 'is_filter' => true];
        $filters = SpecificationService::findAll($query_filter);

        $min_filter_price = \request()->priceRange ? intval(explode('_', \request()->priceRange)[0]) : $min_price;
        $max_filter_price = \request()->priceRange ? intval(explode('_', \request()->priceRange)[1]) : $max_price;
        return view('pages.product-list.index', compact(['product_category', 'children',
            'products', 'brands', 'filters', 'max_price', 'min_price', 'max_filter_price', 'min_filter_price']));
    }

}
