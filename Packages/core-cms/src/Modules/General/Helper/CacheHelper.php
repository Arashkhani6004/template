<?php

namespace Rahweb\CmsCore\Modules\General\Helper;

use Illuminate\Support\Facades\Cache;
//use Illuminate\Support\Facades\Http;

class CacheHelper
{
    public static function clearCache()
    {
//        $response = Http::withoutVerifying()->get(config('setting.template_url')."/flush-cache");
//        return $response->json();
        Cache::flush();
        return true;
    }
}
