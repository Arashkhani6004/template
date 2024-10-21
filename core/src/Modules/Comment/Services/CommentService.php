<?php
namespace Rahweb\CmsCore\Modules\Comment\Services;

use Rahweb\CmsCore\Modules\Comment\DTO\AdminCommentDTO;
use Rahweb\CmsCore\Modules\Comment\Entities\Comment;
use Rahweb\CmsCore\Modules\Comment\DTO\CommentDTO;

class CommentService
{

    public static function create(CommentDTO $commentDTO)
    {
        Comment::create([
            'name' => $commentDTO->getName(),
            'mobile' => $commentDTO->getMobile(),
            'content' => $commentDTO->getContent(),
            'commentable_id' => $commentDTO->getCommentableId(),
            'commentable_type' => $commentDTO->getCommentableType(),
            'reply_id' => $commentDTO->getReplyId(),
            'rate' => $commentDTO->getRate(),
        ]);

    }
    public function update(int $id, AdminCommentDTO $commentDTO)
    {
        $comment= Comment::findOrfail($id);

        $comment->update([

            'content' => $commentDTO->getContent(),
            'status' => $commentDTO->getStatus(),

        ]);

    }
    public function updateStatus(int $id)
    {
        $comment = Comment::findOrfail($id);
        $comment->status = $comment->status == 1 ? 0 : 1;
        $comment->save();
    }

    public function destroy(int $id)
    {
        $Service = Comment::find($id);
        Comment::destroy($id);
    }
}
