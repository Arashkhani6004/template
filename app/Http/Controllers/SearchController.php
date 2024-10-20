<?php

namespace App\Http\Controllers;

use App\Library\Assistant\Modules\V1\General;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Rahweb\CmsCore\Modules\Blog\Entities\Blog;
use Rahweb\CmsCore\Modules\Product\Entities\Brand;
use Rahweb\CmsCore\Modules\Product\Entities\Product;
use Rahweb\CmsCore\Modules\Product\Entities\ProductCategory;
use Rahweb\CmsCore\Modules\Service\Entities\Service;
use Rahweb\CmsCore\Modules\Service\Entities\WorkSample;

class SearchController extends Controller
{
    public function detail(Request $request)
    {
        $search = $request->get('search');
        $takeCount = $request->get('search_form') != null ? null : 3;

        $searched_blogs = $this->performSearch(Blog::class, $search, $takeCount);
        $searched_portfolios = $this->performSearch(WorkSample::class, $search, $takeCount);
        $searched_services = $this->performSearch(Service::class, $search, $takeCount);
        $searched_brands = $this->performSearch(Brand::class, $search, $takeCount, ['id', 'title', 'url']);
        $searched_categories = $this->performSearch(ProductCategory::class, $search, $takeCount, ['id', 'title', 'url']);
        $searched_products = $this->performSearch(Product::class, $search, $takeCount, ['id', 'title', 'url', 'image', 'price', 'final_price', 'discounted_price'], $takeCount == null ? 6 : $takeCount);

        return view('pages.search.index', compact(
            'searched_brands',
            'searched_products',
            'searched_categories',
            'searched_blogs',
            'searched_portfolios',
            'searched_services',
            'search'
        ));
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
