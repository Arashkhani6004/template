<?php

namespace App\Providers;

use App\Library\SiteHelper;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!app()->runningInConsole()) {
            SiteHelper::setSiteInformation();
        }

        if (env('APP_ENV') == "production") {
            URL::forceScheme('https');
        }
        Blade::directive('toPersianNumber', function ($expression) {
            return "<?php echo \App\Library\NumberHelper::latin2PersianDigit($expression) ?>";
        });
        Blade::if('mobile', function () {
            if (isset($_SERVER["HTTP_USER_AGENT"])) {
                return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
            } else {
                return false;
            }
        });
    }
}
