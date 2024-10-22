<?php

namespace Rahweb\CmsCore\Modules\General\Http\Controllers\Api\V1;

use Rahweb\CmsCore\Modules\Seo\Services\SeoService;
use Rahweb\CmsCore\Modules\Service\Http\Resources\LayoutServiceCollection;
use Rahweb\CmsCore\Modules\Service\Http\Resources\ServiceCollection;
use Rahweb\CmsCore\Modules\Service\Services\ServiceManager;
use Rahweb\CmsCore\Modules\Setting\Http\Resources\SettingCollection;
use Rahweb\CmsCore\Modules\Setting\Http\Resources\ThemeCollection;
use Rahweb\CmsCore\Modules\Setting\Services\SettingService;
use Rahweb\CmsCore\Modules\Setting\Services\ThemeService;
use Rahweb\CmsCore\Modules\Setting\Services\BranchService;
use Rahweb\CmsCore\Modules\Page\Services\PageService;
use Rahweb\CmsCore\Modules\Setting\Services\SocialService;
use Rahweb\CmsCore\Modules\Product\Http\Resources\LayoutProductCategoryCollection;
use Rahweb\CmsCore\Modules\Product\Services\ProductCategoryService;

class LayoutController
{
    public function __construct(
        PageService    $pageService,
        ServiceManager $serviceManager,
        SettingService $settingService,
        ThemeService $themeService,
        SocialService  $socialService,
        BranchService  $branchService,
        SeoService  $seoService,
        ProductCategoryService  $productCategoryService,
    )
    {
        $this->pageService = $pageService;
        $this->serviceManager = $serviceManager;
        $this->settingService = $settingService;
        $this->themeService = $themeService;
        $this->socialService = $socialService;
        $this->branchService = $branchService;
         $this->seoService = $seoService;
         $this->productCategoryService = $productCategoryService;
    }

    public function getLayoutData()
    {
        $settings = new SettingCollection($this->settingService->findAll());
        $themes = new ThemeCollection($this->themeService->findAll());
        $service_manager = $this->serviceManager->findAll(['layout' => 1],false);
        $service_manager_menu = $this->serviceManager->findAll(['layout' => 1,'list'=>1],false);
        $serviceCollection = new ServiceCollection($service_manager);
        $serviceCollection->setHiddenFields(['children', 'samples','parent_url','description']);
        $services = $serviceCollection->toArray(request());
        $serviceMenuCollection = new LayoutServiceCollection($service_manager_menu);
        $serviceMenuCollection->setHiddenFields(['samples','parent_url','description']);
        $serviceMenuCollection->setChildrenHiddenFields(['samples','parent_url','description']);
        $menu_services = $serviceMenuCollection->toArray(request());
        $product_category_menu = $this->productCategoryService->findAll(['layout' => 1,'list'=>1],false);
        $productCategoryMenuCollection = new LayoutProductCategoryCollection($product_category_menu);
        $productCategoryMenuCollection->setHiddenFields(['samples','parent_url','description']);
        $productCategoryMenuCollection->setChildrenHiddenFields(['samples','parent_url','description']);
        $menu_product_categories = $productCategoryMenuCollection->toArray(request());
        $branches = $this->branchService->findAll();
        $socials = $this->socialService->findAll();
        $url ="";
        $first_seo = $this->seoService->findUrlStatic($url);
        return response()->json([
            'data' => compact(
                'socials',
                'services',
                'menu_services',
                'branches',
                'settings',
                'themes',
                'first_seo',
                'menu_product_categories'
            ),
            'success' => true,
        ]);
    }
}
