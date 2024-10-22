<?php

namespace Rahweb\CmsCore\Modules\Banner\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\Banner\DTO\BannerDTO;
use Rahweb\CmsCore\Modules\Banner\Entities\Banner;
use Rahweb\CmsCore\Modules\Banner\Http\Requests\BannerRequest;
use Rahweb\CmsCore\Modules\Banner\Services\BannerService;
use Rahweb\CmsCore\Modules\General\Helper\CacheHelper;

class BannerController extends Controller
{
    protected $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function index(Request $request)
    {
        $query = Banner::query();
        $banner = $query->paginate(20);
        return view('CmsCore::banner.index', compact('banner'));
    }

    public function create()
    {
        return view('CmsCore::banner.create');
    }

    public function store(BannerRequest $request)
    {
        $this->bannerService->create(BannerDTO::fromRequest($request));
        CacheHelper::clearCache();
        return redirect()
            ->route('admin.banner.index')
            ->with('success', 'بنر جدید اضافه شد.');
    }

    public function edit($id)
    {
        $data = Banner::findOrfail($id);
        return view('CmsCore::banner.edit', compact('data'));
    }

    public function update($id, BannerRequest $request)
    {
        $this->bannerService->update($id, BannerDTO::fromRequest($request));
        CacheHelper::clearCache();
        return redirect()->route('admin.banner.index')
            ->with('success', 'بنر ویرایش شد.');
    }

    public function destroy($id)
    {
        $this->bannerService->destroy($id);
        CacheHelper::clearCache();
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }
}
