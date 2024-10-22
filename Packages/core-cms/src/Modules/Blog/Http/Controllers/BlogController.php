<?php

namespace Rahweb\CmsCore\Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\Blog\DTO\BlogDTO;
use Rahweb\CmsCore\Modules\Blog\Entities\Blog;
use Rahweb\CmsCore\Modules\Blog\Entities\BlogCategory;
use Rahweb\CmsCore\Modules\Blog\Filters\BlogFilter;
use Rahweb\CmsCore\Modules\Blog\Http\Requests\BlogRequest;
use Rahweb\CmsCore\Modules\Blog\Services\BlogService;
use Rahweb\CmsCore\Modules\Service\Entities\Service;

class BlogController extends Controller
{
    protected $blogService;
    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }
    /**
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $query = Blog::query();
        if ($request->has(['title', 'parent_id'])) {
            $filters = [
                'title' => $request->input('title'),
                'parent_id' => $request->input('parent_id'),
            ];
            $query = app(BlogFilter::class)->apply($query, $filters);
        }
        $blog = $query->orderby('id', 'DESC')->paginate(20);
        $category = BlogCategory::orderby('id', 'DESC')->get();
        return view('CmsCore::blog.blog.index', compact('blog', 'category'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $category = BlogCategory::orderby('id', 'DESC')->get();
        $services = Service::orderBy('id', 'DESC')->select(['title', 'id'])->get();
        return view('CmsCore::blog.blog.create', compact('category', 'services'));

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(BlogRequest $request)
    {
        $this->blogService->create(BlogDTO::fromRequest($request));
        return redirect()->route('admin.blog.index')
            ->with('success', ' مطلب جدید اضافه شد.');
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data = Blog::findOrfail($id);
        $category = BlogCategory::orderby('id', 'DESC')->get();
        $services = Service::orderBy('id', 'DESC')->select(['title', 'id'])->get();
        $selected_services = $data->services;
        return view('CmsCore::blog.blog.edit', compact('category', 'data', 'services', 'selected_services'));

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(BlogRequest $request, $id)
    {
        //
        $this->blogService->update($id, BlogDTO::fromRequest($request));
        return redirect()->route('admin.blog.index')
            ->with('success', 'مطلب ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        $this->blogService->destroy($id);
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }
}
