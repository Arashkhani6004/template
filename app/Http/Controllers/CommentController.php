<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\Comment\DTO\CommentDTO;
use Rahweb\CmsCore\Modules\Comment\Http\Requests\CommentRequest;
use Rahweb\CmsCore\Modules\Comment\Services\CommentService;

class CommentController extends Controller
{
    public function postComment(CommentRequest $request)
    {
        CommentService::create(CommentDTO::fromRequest($request));
        return Redirect::back()->with('success', 'نظر شما با موفقیت ثبت شد');
    }

}
