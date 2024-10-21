<?php

namespace Rahweb\CmsCore\Modules\General\Http\Controllers\Api\V1;

use Rahweb\CmsCore\Modules\Service\Entities\Service;
use Rahweb\CmsCore\Modules\Service\Http\Resources\LayoutServiceCollection;
use Rahweb\CmsCore\Modules\Service\Http\Resources\SearchedServiceCollection;
use Rahweb\CmsCore\Modules\Blog\Entities\Blog;
use Rahweb\CmsCore\Modules\Blog\Http\Resources\BlogCollection;
use Rahweb\CmsCore\Modules\Blog\Http\Resources\SearchedBlogCollection;
use Rahweb\CmsCore\Modules\Service\Entities\WorkSample;
use Rahweb\CmsCore\Modules\Service\Http\Resources\FirstPageWorkSampleCollection;
use Rahweb\CmsCore\Modules\Service\Http\Resources\SearchedWorkSampleCollection;
use Rahweb\CmsCore\Modules\Product\Entities\Brand;
use Rahweb\CmsCore\Modules\Product\Entities\Product;
use Rahweb\CmsCore\Modules\Product\Entities\ProductCategory;
use Rahweb\CmsCore\Modules\Product\Http\Resources\ProductCollection;
use Rahweb\CmsCore\Modules\Product\Http\Resources\SearchedBrandCollection;
use Rahweb\CmsCore\Modules\Product\Http\Resources\SearchedCategoryCollection;
use Rahweb\CmsCore\Modules\Product\Http\Resources\SearchedProductCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController
{

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function getData(Request $request): JsonResponse
    {

        $search = $request->get('search');
        $takeCount = $request->get('search_form') != null ? null : 3;

        $blogs = $this->performSearch(Blog::class, $search, $takeCount);
        $portfolios = $this->performSearch(WorkSample::class, $search, $takeCount);
        $services = $this->performSearch(Service::class, $search, $takeCount);
        $brands = $this->performSearch(Brand::class, $search, $takeCount, ['id', 'title', 'url']);
        $categories = $this->performSearch(ProductCategory::class, $search, $takeCount, ['id', 'title', 'url']);
        $products = $this->performSearch(Product::class, $search, $takeCount, ['id', 'title', 'url', 'image', 'price', 'final_price', 'discounted_price'], $takeCount == null ? 6 : $takeCount);
         $searched_products = $request->get('search_form') != null ? new ProductCollection(@$products)  : new SearchedProductCollection(@$products);

            $searched_services = $request->get('search_form') != null ? new LayoutServiceCollection(@$services) : new SearchedServiceCollection(@$services);
            $searched_blogs =  $request->get('search_form') != null ? new BlogCollection(@$blogs) : new SearchedBlogCollection(@$blogs);
            $searched_portfolios = $request->get('search_form') != null ? new FirstPageWorkSampleCollection(@$portfolios) : new SearchedWorkSampleCollection(@$portfolios);
            
        $searched_brands = new SearchedBrandCollection(@$brands);
        $searched_categories = new SearchedCategoryCollection(@$categories);

        return response()->json([
            'data' => compact(
                'searched_blogs',
                'searched_portfolios',
                'searched_services',
                'searched_brands',
                'searched_categories',
                'searched_products'
            ),
            'success' => true,
        ]);
    }
    private function performSearch($model, $search, $takeCount, $select = ['*'])
    {
        $query = $model::whereSearch($search)
            ->orderBy('id', 'DESC')
            ->select($select);

        if ($takeCount !== null) {
            $query->take($takeCount);
        }

        return $query->get();
    }

}
