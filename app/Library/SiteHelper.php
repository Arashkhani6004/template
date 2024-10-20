<?php

namespace App\Library;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Rahweb\CmsCore\Modules\Seo\Services\RedirectService;

class SiteHelper
{
    public static function getInformation()
    {
        $url = request()->header('site-name') ?? request()->getHost();
        $site_name = trim(strtolower(str_replace('www.', '', $url)));
        $jsonData = Storage::disk('local')->get('private/config-sites-data.json');
        $sites = collect(json_decode($jsonData, true));
        return $sites->first(function ($site) use ($site_name) {
            return str_contains($site['template_url'], $site_name);
        });
    }

    public static function setSiteInformation()
    {
        $site = self::getInformation();
        if (!$site) {
            abort(404);
        }
        DB::disconnect('mysql');
        if ($site['template_url'] !== "localhost") {
            Config::set('setting.base_upload_folder', "sites/" . $site['site_name']);
            Config::set('setting.base_serve_folder', "");
            Config::set('setting.template_url', "https://" . $site['template_url']);
            Config::set('database.connections.mysql', array_merge(
                config('database.connections.mysql'),
                [
                    "username" => 'root',
                    'database' => 'cms_' . $site['site_name']
                ]
            ));
        }
        return true;
    }

    public static function checkRedirect($address)
    {
        $address = trim(str_replace(url('/'), "", $address), '/');
        $redirect = RedirectService::findNotRedirected($address);
        return $redirect;
    }
}
