<?php

namespace Rahweb\CmsCore\Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\Blog\DTO\BlogCategoryDTO;
use Rahweb\CmsCore\Modules\Blog\Entities\BlogCategory;
use Rahweb\CmsCore\Modules\Blog\Filters\BlogCategoryFilter;
use Rahweb\CmsCore\Modules\Blog\Http\Requests\BlogCategoryRequest;
use Rahweb\CmsCore\Modules\Blog\Services\BlogCategoryService;
use Rahweb\CmsCore\Modules\General\Helper\CacheHelper;

class BlogCategoryController extends Controller
{
    protected $blogCategoryService;

    public function __construct(BlogCategoryService $blogCategoryService)
    {
        $this->blogCategoryService = $blogCategoryService;
    }

    /**
     * /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $query = BlogCategory::query();
        if ($request->has(['title', 'parent_id'])) {
            $filters = [
                'title' => $request->input('title'),
                'parent_id' => $request->input('parent_id'),
            ];
            $query = app(BlogCategoryFilter::class)->apply($query, $filters);
        }
        $blog_category = $query->paginate(20);
        return view('CmsCore::blog.blog-category.index', compact('blog_category'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $mainCategory = collect([
            [
                'id' => null,
                'title' => 'دسته اصلی',
                'value' => null,
            ]
        ]);

        $category = BlogCategory::orderby('id', 'DESC')->get();

        $category = $mainCategory->merge($category);
        return view('CmsCore::blog.blog-category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(BlogCategoryRequest $request)
    {

        $this->blogCategoryService->create(BlogCategoryDTO::fromRequest($request));
        CacheHelper::clearCache();
        return redirect()->route('admin.blog-category.index')
            ->with('success', 'دسته بندی مطلب جدید اضافه شد.');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data = BlogCategory::findOrfail($id);
        $mainCategory = collect([
            [
                'id' => null,
                'title' => 'دسته اصلی',
                'value' => null,
            ]
        ]);

        $category = BlogCategory::orderby('id', 'DESC')->where('id', '<>', $id)->get();

        $category = $mainCategory->merge($category);
        return View('CmsCore::blog.blog-category.edit', compact('data', 'category'));

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(BlogCategoryRequest $request, $id)
    {
        $this->blogCategoryService->update($id, BlogCategoryDTO::fromRequest($request));
        CacheHelper::clearCache();
        return redirect()->route('admin.blog-category.index')
            ->with('success', 'دسته بندی مطلب ویرایش شد.');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        $this->blogCategoryService->destroy($id);
        CacheHelper::clearCache();
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }
}
