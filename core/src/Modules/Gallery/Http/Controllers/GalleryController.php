<?php

namespace Rahweb\CmsCore\Modules\Gallery\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\Gallery\DTO\GalleryDTO;
use Rahweb\CmsCore\Modules\Gallery\Entities\Gallery;
use Rahweb\CmsCore\Modules\Gallery\Entities\GalleryCategory;
use Rahweb\CmsCore\Modules\Gallery\Filters\GalleryFilter;
use Rahweb\CmsCore\Modules\Gallery\Http\Requests\GalleryRequest;
use Rahweb\CmsCore\Modules\Gallery\Services\GalleryService;
use Rahweb\CmsCore\Modules\General\Helper\CacheHelper;

class GalleryController extends Controller
{
    protected $galleryService;
    public function __construct(GalleryService $galleryService)
    {
        $this->galleryService = $galleryService;
    }
    /**
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $query = Gallery::query();
        if ($request->has(['title', 'parent_id'])) {
            $filters = [
                'title' => $request->input('title'),
                'parent_id' => $request->input('parent_id'),
            ];
            $query = app(GalleryFilter::class)->apply($query, $filters);
        }
        $gallery = $query->orderBy('id', 'DESC')->paginate(20);
        $categories = GalleryCategory::orderBy('id', 'DESC')->get();
        return view('CmsCore::gallery.gallery.index', compact('gallery', 'categories'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories = GalleryCategory::orderBy('id', 'DESC')->get();
        return view('CmsCore::gallery.gallery.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(GalleryRequest $request)
    {

        $this->galleryService->create(GalleryDTO::fromRequest($request));
        CacheHelper::clearCache();
        return redirect()->route('admin.gallery.index')
            ->with('success', 'تصویر جدید اضافه شد.');
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data = Gallery::findOrfail($id);
        $categories = GalleryCategory::orderBy('id', 'DESC')->get();

        return view('CmsCore::gallery.gallery.edit', compact('categories', 'data'));

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(GalleryRequest $request, $id)
    {
        $this->galleryService->update($id, GalleryDTO::fromRequest($request));
        CacheHelper::clearCache();
        return redirect()->route('admin.gallery.index')
            ->with('success', 'تصویر ویرایش شد.');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        $this->galleryService->destroy($id);
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }
}
