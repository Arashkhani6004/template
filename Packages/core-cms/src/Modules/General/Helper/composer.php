<?php


use Rahweb\CmsCore\Modules\Service\Entities\Service;
use Rahweb\CmsCore\Modules\Setting\Entities\Setting;
use Rahweb\CmsCore\Modules\Present\Branch\Entities\Branch;
use Rahweb\CmsCore\Modules\Present\Social\Entities\Social;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
$settings = Setting::all();
$setting=[];
$branch=[];
$footer_services=[];
foreach ($settings as $set){
    @$setting[$set->key] = $set->value;
}
$footer_services = Service::orderBy('id','DESC')->whereNull('parent_id')->get();
$main_branch = Branch::orderBy('id','DESC')->MainBranch()->first();
$socials = Social::orderBy('id','DESC')->get();
$seg=[];
$seg = \request()->segments();
View::share([
    'seg' => $seg,
    'setting' => $setting,
    'footer_services' => $footer_services,
    'main_branch' => $main_branch,
    'socials' => $socials,
]);
