<?php

namespace Rahweb\CmsCore\Modules\Seo\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\General\Helper\CacheHelper;
use Rahweb\CmsCore\Modules\Seo\DTO\RedirectDTO;
use Rahweb\CmsCore\Modules\Seo\Http\Requests\RedirectRequest;
use Rahweb\CmsCore\Modules\Seo\Services\RedirectService;
use \Rahweb\CmsCore\Modules\Seo\Entities\Redirect as RD;

class RedirectController extends Controller
{
    protected $redirectService;
    public function __construct(RedirectService $redirectService)
    {
        $this->redirectService = $redirectService;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function index()
    {

        $redirect = RD::orderBy('id', 'desc')->paginate(20);
        return view('CmsCore::seo.redirect.index', compact('redirect'));
    }
    public function create()
    {
        return view('CmsCore::seo.redirect.create');

    }
    public function store(RedirectRequest $request)
    {
        $check = RD::orderBy('id', 'DESC')->where('old_address', '/' . trim(str_replace(url('/'), "", $request->get('old_address')), '/'))->first();
        if ($check) {
            $check->delete();
        }
        $this->redirectService->create(RedirectDTO::fromRequest($request));
        CacheHelper::clearCache();
        return redirect()->route('admin.redirect.index')->with('success', 'ریدایرکت ذخیره شد.');
    }
    public function destroy($id)
    {
        $this->redirectService->destroy($id);
        CacheHelper::clearCache();
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }

}
