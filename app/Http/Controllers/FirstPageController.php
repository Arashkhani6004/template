<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Rahweb\CmsCore\Modules\Banner\Services\BannerService;
use Rahweb\CmsCore\Modules\Certification\Services\CertificateService;
use Rahweb\CmsCore\Modules\Gallery\Services\GalleryCategoryService;
use Rahweb\CmsCore\Modules\Gallery\Services\GalleryService;
use Rahweb\CmsCore\Modules\Location\Entities\City;
use Rahweb\CmsCore\Modules\Location\Entities\State;
use Rahweb\CmsCore\Modules\Product\Services\ProductCategoryService;
use Rahweb\CmsCore\Modules\Product\Services\ProductService;
use Rahweb\CmsCore\Modules\Service\Services\PackageService;
use Rahweb\CmsCore\Modules\Service\Services\ServiceManager;
use Rahweb\CmsCore\Modules\Service\Services\WorkSampleService;
use Rahweb\CmsCore\Modules\Tag\Services\TagService;
use Rahweb\CmsCore\Modules\User\Services\UserService;
use Illuminate\Support\Facades\File;
class FirstPageController extends Controller
{
    public function index()
    {

        $query = ['first_page' => true];
        $services = ServiceManager::findAll($query, false);
        $banners = BannerService::findAll($query);
        $samples = WorkSampleService::findAll($query, 10);
        $gallery_categories = GalleryCategoryService::findAll($query, 4);
        $galleries = GalleryService::findAll($query);
        $team_members = UserService::findAll($query);
        $certificates = CertificateService::findAll($query);
        $packages = PackageService::findAll($query, 3);
        $products = ProductService::findAll($query,null,12);
        $product_categories = ProductCategoryService::findAll($query,false);
        $query_timer = ['timer' => true];
        $timer_products = ProductService::findAll($query_timer);
        $tags = TagService::findAll($query);

        return view('pages.first-page.index', compact(
            ['banners', 'services', 'samples', 'gallery_categories', 'galleries'
                , 'team_members', 'certificates', 'packages', 'products', 'product_categories', 'timer_products',
                'tags',
            ]));
    }
}
