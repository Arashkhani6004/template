<?php

namespace Rahweb\CmsCore\Modules\Seo\Http\Controllers;

use Rahweb\CmsCore\Modules\General\Helper\CacheHelper;
use Rahweb\CmsCore\Modules\Seo\DTO\SeoDTO;
use Rahweb\CmsCore\Modules\Seo\Entities\SeoMeta;
use Rahweb\CmsCore\Modules\Seo\Http\Requests\SeoRequest;
use Rahweb\CmsCore\Modules\Seo\Http\Requests\StaticSeoRequest;
use Rahweb\CmsCore\Modules\Seo\Services\SeoService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SeoController extends Controller
{
    protected $SeoService;
    public function __construct(SeoService $seoService)
    {
        $this->seoService = $seoService;
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(SeoRequest $request)
    {
        $this->seoService->create(SeoDTO::fromRequest($request));
        CacheHelper::clearCache();
        return redirect()->back()->with('success', 'اطلاعات سئو ذخیره شد.');
    }
    public function index()
    {

        $data = SeoMeta::orderBy('id','desc')->whereNotNull('url')->get();
        return view('CmsCore::seo.seo.index', compact('data'));
    }
    public function edit(int $id)
    {
        $data = SeoMeta::findOrFail($id);
        return view('CmsCore::seo.seo.edit', compact('data'));
    }
    public function update(StaticSeoRequest $request, int $id)
    {
        $this->seoService->update($id, SeoDTO::fromStaticRequest($request));
        CacheHelper::clearCache();
        return redirect()->route('admin.seo.index')->with('success', 'آیتم ویرایش شد.');
    }
}
