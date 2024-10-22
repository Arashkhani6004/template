<?php

namespace Rahweb\CmsCore\Modules\Setting\Http\Controllers;

use Rahweb\CmsCore\Modules\General\Helper\CacheHelper;
use Rahweb\CmsCore\Modules\General\Helper\MakeTree;
use Rahweb\CmsCore\Modules\Service\DTO\ServiceDTO;
use Rahweb\CmsCore\Modules\Service\Entities\Service;
use Rahweb\CmsCore\Modules\Service\Filters\ServiceFilter;
use Rahweb\CmsCore\Modules\Service\Http\Requests\ServiceRequest;
use Rahweb\CmsCore\Modules\Service\Services\ServiceManager;
use Rahweb\CmsCore\Modules\Setting\DTO\SettingDTO;
use Rahweb\CmsCore\Modules\Setting\Entities\Setting;
use Rahweb\CmsCore\Modules\Setting\Services\ThemeService;
use Rahweb\CmsCore\Modules\Service\Entities\WorkSample;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;

class ThemeController extends Controller
{
    protected $themeService;
    public function __construct(ThemeService $themeService)
    {
        $this->themeService = $themeService;
    }
    /**
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $theme_types = \Config::get('settings.menu_and_theme_types');
        return view('CmsCore::setting.theme.edit', compact('theme_types'));
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {

        //
        $result = $this->themeService->update($request);
        if($result instanceof RedirectResponse == false){
            CacheHelper::clearCache();
            return Redirect::action([ThemeController::class, 'index'])->with('success', 'آیتم ویرایش شد.');
        }else{
           return $result;
        }

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        $this->themeService->destroy($id);
        CacheHelper::clearCache();
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }
    public function deleteAll($id)
    {
        //
        $this->themeService->destroyAll($id);
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }
}
