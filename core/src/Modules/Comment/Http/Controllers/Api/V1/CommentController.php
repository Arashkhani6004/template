<?php

namespace Rahweb\CmsCore\Modules\Comment\Http\Controllers\Api\V1;

use Rahweb\CmsCore\Modules\Comment\DTO\CommentDTO;
use Rahweb\CmsCore\Modules\Comment\Http\Requests\CommentRequest;
use Rahweb\CmsCore\Modules\Comment\Services\CommentService;
use Illuminate\Http\JsonResponse;

class CommentController

{
    public function __construct(
        CommentService         $commentService,
    )
    {
        $this->commentService = $commentService;
    }

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function create(CommentRequest $request): JsonResponse
    {
        $this->commentService->create(CommentDTO::fromRequest($request));
        return response()->json([
            'success' => true
        ]);
    }


}
