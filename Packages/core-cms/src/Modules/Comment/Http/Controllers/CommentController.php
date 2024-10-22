<?php

namespace Rahweb\CmsCore\Modules\Comment\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\Comment\DTO\AdminCommentDTO;
use Rahweb\CmsCore\Modules\Comment\Entities\Comment;
use Rahweb\CmsCore\Modules\Comment\Filters\CommentFilter;
use Rahweb\CmsCore\Modules\Comment\Http\Requests\AdminCommentRequest;
use Rahweb\CmsCore\Modules\Comment\Services\CommentService;

class CommentController extends Controller
{

    protected $commentService;
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $query = Comment::query();

        if ($request->has(['reply_id'])) {
            $filters = [
                'reply_id' => $request->input('reply_id'),
            ];
            $query = app(CommentFilter::class)->apply($query, $filters);
        }
        $comment = $query->paginate(20);
        return view('CmsCore::comment.index', compact('comment'));

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data = Comment::findOrfail($id);
        return view('CmsCore::comment.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update($id, AdminCommentRequest $request)
    {
        $this->commentService->update($id, AdminCommentDTO::fromRequest($request));
        return Redirect::action([CommentController::class, 'index'])->with('success', 'آیتم ویرایش شد.');
    }

    public function updateStatus($id)
    {
        $this->commentService->updateStatus($id);
        return Redirect::action([CommentController::class, 'index'])->with('success', 'وضعیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->commentService->destroy($id);
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }
}
