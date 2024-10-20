<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Rahweb\CmsCore\Modules\Seo\Services\RedirectService;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/home';

    public function boot()
    {
        $redirect_address = $this->getRedirectAddress();
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        $this->handleRedirects($redirect_address);
    }

    protected function getRedirectAddress()
    {
        $site_name = strtolower(str_replace('www.', '', request()->getHost()));
        if (Schema::hasTable('redirects')) {
            if (Cache::has('redirect_address_' . $site_name)) {
                return Cache::get('redirect_address_' . $site_name);
            } else {
                $redirects = RedirectService::findAll();
                if ($redirects != null) {
                    Cache::put('redirect_address_' . $site_name, $redirects, now()->addDay());
                }
                return $redirects;
            }
        }
    }

    protected function handleRedirects($redirect_address)
    {
        $address = \request()->path();
        if (@$redirect_address) {
            foreach ($redirect_address as $redirect) {
                $old_address = trim($redirect['old_address'], '/');
                if (strcasecmp($address, $old_address) === 0) {
                    return redirect()->to($redirect['new_address'], 301)->send();
                }
            }
        }
    }


    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
