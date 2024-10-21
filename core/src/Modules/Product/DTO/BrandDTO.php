<?php

namespace Rahweb\CmsCore\Modules\Product\DTO;

use Rahweb\CmsCore\Modules\Product\Http\Requests\BrandRequest;
use Rahweb\CmsCore\Modules\Product\Http\Requests\ProductCategoryRequest;
use Illuminate\Http\UploadedFile;

class BrandDTO
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
    protected string|null $description;
    public function getDescription(): ?string
    {
        return $this->description;
    }
    public bool $active;
    public function getActive(): bool
    {
        return $this->active;
    }
    public static function fromRequest(BrandRequest $request)
    {

        $self = new self();
        $self->title = $request->get('title');
        $self->description = $request->get('description');
        $self->image = $request->file('image');
        $self->active = $request->has('active');
        $self->url = trim(str_replace(' ', '-',@$request->get('url')));
        return $self;
    }
}
