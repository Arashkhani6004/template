<?php

namespace Rahweb\CmsCore\Modules\General\Helper;

use Illuminate\Support\Facades\Storage;

class SiteHelper
{
    public static function getInformation()
    {
        $url = request()->header('site-name') ?? request()->getHost();
        $site_name = trim(strtolower(str_replace('www.', '', $url)));
        $jsonData = Storage::disk('local')->get('private/config-sites-data.json');
        $sites = collect(json_decode($jsonData, true));
        return $sites->first(function ($site) use ($site_name) {
            return str_contains($site['core_url'], $site_name) || str_contains($site['template_url'], $site_name);
        });
    }
}
