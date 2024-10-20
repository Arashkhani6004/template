<?php

namespace App\Http\Controllers\Shop;

use App\Library\Assistant\Modules\V1\Shop;
use Rahweb\CmsCore\Modules\Product\Http\Resources\PaginateProductCollection;
use Rahweb\CmsCore\Modules\Product\Http\Resources\ProductCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller;
use Rahweb\CmsCore\Modules\Product\Services\ProductService;
use Rahweb\CmsCore\Modules\Product\Services\SpecificationService;
use Rahweb\CmsCore\Modules\Setting\Services\SloganService;

class ProductController extends Controller
{
    public function detail($url)
    {
        $product = ProductService::findOne($url);
        $categories = $product->categories;
        $brand = @$product->brand;
        $slogans = SloganService::findAll();
        $properties = $product->properties;
        $faqs = $product->faqs;
        $videos = $product->videos;
        $images = ProductService::getProductImagesSizeSeperated($product->images);
        $tags = $product->tags;

        //specifications
        $specifications = $product->specifications->groupBy('parent_id');
        //check this
        $specification_values = SpecificationService::getFormatTextSpecifications($product);
        //check this

        $comments = $product->comments;
        $rate = 0;
        if (count($comments) > 0) {
            $rate = ($product->comments->sum('rate') / count($comments));
        }

        if (count($product->related) > 0) {
            $related_products = $product->related->take(7);
        } else {
            //check this line
            $query = ['categories' => $categories->pluck('id')->toArray()];
            $related_products = ProductService::findAll($query, $product['id'], 7);
        }
        $complement_products = $product->complement->take(7);

        return view('pages.product-detail.index', compact('product', 'brand',
            'categories', 'comments', 'slogans', 'specifications', 'specification_values', 'properties', 'rate',
            'faqs', 'videos', 'images', 'related_products','complement_products', 'tags'));
    }

    public function getDiscountedProducts()
    {
        $query_timer = ['timer' => true,'paginate'=>true];
        $found_timers =  ProductService::findAll($query_timer);
        $products = $found_timers->paginate(12);
        $timer_products = ProductService::findAll(['timer' => true]);
        return view('pages.discounted-list.index', compact('timer_products',  'products'));
    }
}
