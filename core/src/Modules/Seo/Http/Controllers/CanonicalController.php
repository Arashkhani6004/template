<?php

namespace Rahweb\CmsCore\Modules\Seo\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\General\Helper\CacheHelper;
use Rahweb\CmsCore\Modules\Seo\DTO\CanonicalDTO;
use Rahweb\CmsCore\Modules\Seo\Entities\Canonical;
use Rahweb\CmsCore\Modules\Seo\Http\Requests\CanonicalRequest;
use Rahweb\CmsCore\Modules\Seo\Services\CanonicalService;

class CanonicalController extends Controller
{
    protected $canonicalService;
    public function __construct(CanonicalService $canonicalService)
    {
        $this->canonicalService = $canonicalService;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function index()
    {

        $canonical = Canonical::orderBy('id', 'desc')->paginate(20);
        return view('CmsCore::seo.canonical.index', compact('canonical'));
    }
    public function create()
    {
        return view('CmsCore::seo.canonical.create');

    }
    public function store(CanonicalRequest $request)
    {
        $this->canonicalService->create(CanonicalDTO::fromRequest($request));
        CacheHelper::clearCache();
        return redirect()->route('admin.canonical.index')->with('success', 'کنونیکال ذخیره شد.');
    }
    public function edit($id)
    {
        $data = Canonical::findOrfail($id);
        return view('CmsCore::seo.canonical.edit', compact('data'));

    }
    public function update(CanonicalRequest $request, $id)
    {
        //
        $this->canonicalService->update($id, CanonicalDTO::fromRequest($request));
        CacheHelper::clearCache();
        return redirect()->route('admin.canonical.index')
            ->with('success', 'کنونیکال ویرایش شد.');
    }
    public function destroy($id)
    {
        //
        $this->canonicalService->destroy($id);
        CacheHelper::clearCache();
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }

}
