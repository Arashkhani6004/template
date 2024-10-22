<?php

namespace Rahweb\CmsCore\Modules\Setting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\Setting\DTO\SocialDTO;
use Rahweb\CmsCore\Modules\Setting\Entities\Social;
use Rahweb\CmsCore\Modules\Setting\Filters\SocialFilter;
use Rahweb\CmsCore\Modules\Setting\Http\Requests\SocialRequest;
use Rahweb\CmsCore\Modules\Setting\Services\SocialService;

class SocialController extends Controller
{
    protected $socialService;
    public function __construct(SocialService $socialService)
    {
        $this->socialService = $socialService;
    }
    /**
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $query = Social::query();
        if ($request->has(['title', 'parent_id'])) {
            $filters = [
                'title' => $request->input('title'),
                'parent_id' => $request->input('parent_id'),
            ];
            $query = app(SocialFilter::class)->apply($query, $filters);
        }
        $social = $query->orderBy('id', 'DESC')->paginate(20);
        return view('CmsCore::setting.social.index', compact('social'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('CmsCore::setting.social.create');

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(SocialRequest $request)
    {

        //
        $this->socialService->create(SocialDTO::fromRequest($request));
        return redirect()->route('admin.social.index')
            ->with('success', 'آیتم جدید اضافه شد.');
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data = Social::findOrfail($id);

        return view('CmsCore::setting.social.edit', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(SocialRequest $request, $id)
    {

        //
        $this->socialService->update($id, SocialDTO::fromRequest($request));
        return redirect()->route('admin.social.index')
            ->with('success', 'آیتم ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        $this->socialService->destroy($id);
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }
}
