<?php

namespace Rahweb\CmsCore\Modules\Page\DTO;

use Rahweb\CmsCore\Modules\Page\Http\Requests\PageRequest;
use Illuminate\Http\UploadedFile;

class PageDTO
{
    protected string $title;
    public function getTitle(): string
    {
        return $this->title;
    }

    protected UploadedFile|null $image;
    public function getImage(): UploadedFile|null
    {
        return $this->image;
    }
    protected string $url;
    public function getUrl(): string
    {
        return $this->url;
    }

    protected int|null $parent_id;
    public function getParentId(): int|null
    {
        return $this->parent_id;
    }
    protected string $description;
    public function getDescription(): string
    {
        return $this->description;
    }
    protected int|null $show_in_first_page;
    public function getShowInFirstPage(): int|null
    {

        return $this->show_in_first_page;
    }
    public static function fromRequest(PageRequest $request)
    {
        $self = new self();
        $self->title = $request->get('title');
        $self->description = $request->get('description');
        $self->image = $request->file('image');
        $self->parent_id = @$request->get('parent_id');
        $self->url = trim(str_replace(' ', '-',@$request->get('url')));
        $self->show_in_first_page = @$request->has('show_in_first_page') ? 1 : 0;
        return $self;
    }

}
