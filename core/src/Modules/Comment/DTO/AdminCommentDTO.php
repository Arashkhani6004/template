<?php

namespace Rahweb\CmsCore\Modules\Comment\DTO;

use Rahweb\CmsCore\Modules\Comment\Http\Requests\AdminCommentRequest;




class AdminCommentDTO
{

    protected string $content;
    public function getContent(): string
    {
        return $this->content;
    }

    protected int|null $status;
    public function getStatus(): int|null
    {

        return $this->status;
    }

    public static function fromRequest(AdminCommentRequest $request)
    {
        $self = new self();

        $self->content = $request->get('content');
        $self->status = $request->has('status') ? 1 : 0;

        return $self;
    }
}
