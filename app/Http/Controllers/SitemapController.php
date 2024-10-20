<?php

namespace App\Http\Controllers;

use App\Library\Assistant\Modules\V1\Blog;
use Illuminate\Routing\Controller;
use Rahweb\CmsCore\Modules\Blog\Services\BlogCategoryService;
use Rahweb\CmsCore\Modules\Blog\Services\BlogService;
use Rahweb\CmsCore\Modules\Gallery\Services\GalleryCategoryService;
use Rahweb\CmsCore\Modules\Product\Services\BrandService;
use Rahweb\CmsCore\Modules\Product\Services\ProductCategoryService;
use Rahweb\CmsCore\Modules\Product\Services\ProductService;
use Rahweb\CmsCore\Modules\Service\Services\PackageService;
use Rahweb\CmsCore\Modules\Service\Services\ServiceManager;
use Rahweb\CmsCore\Modules\Service\Services\WorkSampleService;
use Rahweb\CmsCore\Modules\Setting\Services\SitemapService;
use Rahweb\CmsCore\Modules\Tag\Services\TagService;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemaps = SitemapService::findAll(['show' => 1]);
        $services = ServiceManager::findAll([],false);
        $blog_categories = BlogCategoryService::findAll();
        $blogs = BlogService::findAll();
        $samples = WorkSampleService::findAll(['with_url'=>1]);
        $gallery_categories = GalleryCategoryService::findAll();
        $packages = PackageService::findAll();
        $product_categories = ProductCategoryService::findAll();
        $brands = BrandService::findAll();
        $products = ProductService::findAll();
        $tags = TagService::findAll();
        return response()->view('pages.site-map.index', [
            'sitemaps' => $sitemaps,
            'services' => $services,
            'blog_categories' => $blog_categories,
            'samples'=>$samples,
            'gallery_categories'=>$gallery_categories,
            'packages'=>$packages,
            'product_categories'=>$product_categories,
            'brands'=>$brands,
            'products'=>$products,
            'tags'=>$tags,
            'blogs'=>$blogs,
        ])->header('Content-Type', 'text/xml');
    }

}
