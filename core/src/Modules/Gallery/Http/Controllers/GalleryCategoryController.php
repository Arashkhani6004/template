<?php

namespace Rahweb\CmsCore\Modules\Gallery\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\Gallery\DTO\GalleryCategoryDTO;
use Rahweb\CmsCore\Modules\Gallery\Entities\GalleryCategory;
use Rahweb\CmsCore\Modules\Gallery\Filters\GalleryCategoryFilter;
use Rahweb\CmsCore\Modules\Gallery\Http\Requests\GalleryCategoryRequest;
use Rahweb\CmsCore\Modules\Gallery\Services\GalleryCategoryService;
use Rahweb\CmsCore\Modules\General\Helper\CacheHelper;

class GalleryCategoryController extends Controller
{
    public function __construct(GalleryCategoryService $galleryCategoryService)
    {
        $this->galleryCategoryService = $galleryCategoryService;
    }
    /**
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $query = GalleryCategory::query();
        if ($request->has(['title', 'parent_id'])) {
            $filters = [
                'title' => $request->input('title'),
            ];
            $query = app(GalleryCategoryFilter::class)->apply($query, $filters);
        }
        $gallery = $query->orderBy('id', 'DESC')->paginate(20);
        return view('CmsCore::gallery.gallery-category.index', compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('CmsCore::gallery.gallery-category.create');

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GalleryCategoryRequest $request)
    {
        $this->galleryCategoryService->create(GalleryCategoryDTO::fromRequest($request));
        CacheHelper::clearCache();
        return redirect()
            ->route('admin.gallery-category.index')
            ->with('success', 'دسته گالری جدید اضافه شد.');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data = GalleryCategory::findOrfail($id);
        return view('CmsCore::gallery.gallery-category.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(GalleryCategoryRequest $request, $id)
    {
        $this->galleryCategoryService->update($id, GalleryCategoryDTO::fromRequest($request));
        CacheHelper::clearCache();
        return redirect()->route('admin.gallery-category.index')
            ->with('success', 'دسته گالری ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->galleryCategoryService->destroy($id);
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }
}
