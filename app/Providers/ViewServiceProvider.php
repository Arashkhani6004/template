<?php

namespace App\Providers;

use App\Library\SiteHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Rahweb\CmsCore\Modules\Blog\Services\BlogCategoryService;
use Rahweb\CmsCore\Modules\Product\Services\ProductCategoryService;
use Rahweb\CmsCore\Modules\Seo\Services\CanonicalService;
use Rahweb\CmsCore\Modules\Seo\Services\SeoService;
use Rahweb\CmsCore\Modules\Service\Services\ServiceManager;
use Rahweb\CmsCore\Modules\Setting\Services\BranchService;
use Rahweb\CmsCore\Modules\Setting\Services\SettingService;
use Rahweb\CmsCore\Modules\Setting\Services\SocialService;
use Rahweb\CmsCore\Modules\Setting\Services\ThemeService;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */

    public function getSettingData(){
        $settings = SettingService::getFormatSettings();
        $themes = ThemeService::getArrayThemeData();
        $footer_services = ServiceManager::findAll(['footer' => 1 , 'list'=>1],false);
        //services
        $menu_services = ServiceManager::findAll(['menu' => 1,'list'=>1],false);
        ///product-cat
        $menu_product_categories = ProductCategoryService::findAll(['layout' => 1,'list'=>1],false);
        $branches = BranchService::findAll();
        $socials = SocialService::findAll();
        $first_seo = SeoService::findUrlStatic("");
        ////posts
        $menu_posts = BlogCategoryService::findAll(['menu' => 1,'list'=>1]);

        return compact(
            'socials',
            'footer_services',
            'menu_services',
            'branches',
            'settings',
            'themes',
            'first_seo',
            'menu_posts',
            'menu_product_categories',
        );
    }

    public function boot(): void
    {
        if (Schema::hasTable('settings')){
            $core_url = env('PUBLIC_BASE_URL') ?? "https://" . @SiteHelper::getInformation()['core_url'] . '/';
            $site_name = @SiteHelper::getInformation()['site_name'];
            if (session()->get('custom_data') == null) {
                session()->put('custom_data', $site_name.strtotime(Carbon::now()));
                session()->save();
            }

            //cache layout
            if (Cache::has('layout_data_' . $site_name)) {
                $layout_data = Cache::get('layout_data_' . $site_name);
            } else {
                $layout_data = self::getSettingData();
                if ($layout_data != null) {
                    Cache::put('layout_data_' . $site_name, $layout_data, now()->addDay());
                }
            }
            if ($layout_data && isset($layout_data['branches'])) {
                $main_branch = collect($layout_data['branches'])->first(function ($item) {
                    return $item['main'] == true;
                });
                View::share([
                    'socials' => $layout_data['socials'],
                    'footer_services' => $layout_data['footer_services'],
                    'menu_services' => $layout_data['menu_services'],
                    'branches' => $layout_data['branches'],
                    'main_branch' => $main_branch,
                    'settings' => $layout_data['settings'],
                    'themes' => @$layout_data['themes'],
                    'default_seo' => $layout_data['first_seo'],
                    'menu_product_categories' => @$layout_data['menu_product_categories'] ? $layout_data['menu_product_categories'] : null,
                    'footer_product_categories' => @$layout_data['footer_product_categories'] ? $layout_data['footer_product_categories'] : null,
                    'menu_posts' => @$layout_data['menu_posts'],
                ]);
            }

            //seo statics
            $seo_data = SeoService::findUrlStatic(implode('/', request()->segments()));
            //cache canonical
            if (Cache::has('canonicals_' . $site_name)) {
                $canonicals = Cache::get('canonicals_' . $site_name);
            } else {
                $canonicals = CanonicalService::findAll();
                if (@$canonicals['data'] != null) {
                    Cache::put('canonicals_' . $site_name, $canonicals, now()->addDay());
                }
            }
            $canonical = url()->current();
            $url = trim(str_replace(url('/'), '', \Illuminate\Support\Facades\URL::current()), '/');

            if(@$canonicals['data']){
                foreach ($canonicals['data']['canonicals'] as $row) {
                    if ($url == trim($row['url'], '/') || '/' . $url == trim($row['url'], '/')) {
                        $canonical = url(@$row['canonical']);
                    }
                }
            }

            View::share([
                'seo_data' => $seo_data,
                'canonical' => $canonical,
                'site_name' => strtolower($site_name),
                'core_url' => $core_url,
            ]);
        }

    }
}
