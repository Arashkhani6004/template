<?php

namespace Rahweb\CmsCore\Modules\Page\Http\Controllers;

use Rahweb\CmsCore\Modules\General\Helper\MakeTree;
use Rahweb\CmsCore\Modules\Page\DTO\PageDTO;
use Rahweb\CmsCore\Modules\Page\Entities\Page;
use Rahweb\CmsCore\Modules\Page\Filters\PageFilter;
use Rahweb\CmsCore\Modules\Page\Http\Requests\PageRequest;
use Rahweb\CmsCore\Modules\Page\Services\PageService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;

class PageController extends Controller
{
    protected $pageService;
    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }
    /**
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $query = Page::query();
        if ($request->has(['title', 'parent_id'])) {
            $filters = [
                'title' => $request->input('title'),
                'parent_id' => $request->input('parent_id'),
            ];
            $query = app(PageFilter::class)->apply($query, $filters);
        }
        $page = $query->get()->toArray();
        if (!empty($page)) {
            MakeTree::getData($page);
            $page = MakeTree::GenerateArray(array('paginate' => 50));
        }
        $category = Page::orderby('id', 'DESC')->get()->toArray();
        if (!empty($category)) {
            MakeTree::getData($category);
            $category = MakeTree::GenerateArray(array('paginate' => 50));
        }
        return view('CmsCore::page.index', compact('page', 'category'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $page = Page::all()->toArray();
        if (!empty($page)) {
            MakeTree::getData($page);
            $page = MakeTree::GenerateArray(array('get'));
        }
        return view('CmsCore::page.create', compact('page'));

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(PageRequest $request)
    {
        //
        $this->pageService->create(PageDTO::fromRequest($request));
        return redirect()->route('admin.page.index')
            ->with('success', ' صفحه جدید اضافه شد.');
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data = Page::findOrfail($id);
        $page = Page::all()->toArray();
        if (!empty($page)) {
            MakeTree::getData($page);
            $page = MakeTree::GenerateArray(array('get'));
        }
        return view('CmsCore::page.edit', compact('page', 'data'));

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(PageRequest $request, $id)
    {
        //
        $this->pageService->update($id, PageDTO::fromRequest($request));
        return redirect()->route('admin.page.index')
            ->with('success', 'صفحه ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        $this->pageService->destroy($id);
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }
}
