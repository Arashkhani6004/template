<?php

namespace Rahweb\CmsCore\Modules\Blog\DTO;

use Rahweb\CmsCore\Modules\Blog\Http\Requests\BlogCategoryRequest;
use Illuminate\Http\UploadedFile;

class BlogCategoryDTO
{
    protected string $title;
    public function getTitle(): string
    {
        return $this->title;
    }

    protected UploadedFile|null $image;
    public function getImage(): ?UploadedFile
    {
        return $this->image;
    }
    protected string $url;
    public function getUrl(): string
    {
        return $this->url;
    }
    protected string $description;
    public function getDescription(): string
    {
        return $this->description;
    }
    protected int|null $parent_id;
    public function getParentId(): ?int
    {
        return $this->parent_id;
    }
    protected bool $status;
    public function getStatus(): bool
    {
        return $this->status;
    }
    public static function fromRequest(BlogCategoryRequest $request)
    {
        $self = new self();
        $self->title = $request->get('title');
        $self->description = $request->get('description');
        $self->image = $request->file('image');
        $self->parent_id = @$request->get('parent_id');
        $self->status = @$request->has('status');
        $self->url = trim(str_replace(' ', '-',@$request->get('url')));
        return $self;
    }
}
