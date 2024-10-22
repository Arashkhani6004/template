<?php

namespace Rahweb\CmsCore\Modules\Tag\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\Tag\DTO\TagDTO;
use Rahweb\CmsCore\Modules\Tag\Entities\Tag;
use Rahweb\CmsCore\Modules\Tag\Filters\TagFilter;
use Rahweb\CmsCore\Modules\Tag\Http\Requests\TagRequest;
use Rahweb\CmsCore\Modules\Tag\Services\TagService;

class TagController extends Controller
{
    protected $tagService;
    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }
    /**
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $query = Tag::query();
        if ($request->has(['title'])) {
            $filters = [
                'title' => $request->input('title'),
            ];
            $query = app(TagFilter::class)->apply($query, $filters);
        }
        $tag = $query->paginate(20);

        return view('CmsCore::tag.index', compact('tag'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        return view('CmsCore::tag.create');

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(TagRequest $request)
    {
        //
        $this->tagService->create(TagDTO::fromRequest($request));
        return redirect()->route('admin.tag.index')
            ->with('success', ' صفحه جدید اضافه شد.');
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data = Tag::findOrfail($id);

        return view('CmsCore::tag.edit', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(TagRequest $request, $id)
    {
        //
        $this->tagService->update($id, TagDTO::fromRequest($request));
        return redirect()->route('admin.tag.index')
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
        $this->tagService->destroy($id);
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }
}
