<?php

namespace Rahweb\CmsCore\Modules\Service\DTO;

use Rahweb\CmsCore\Modules\Service\Http\Requests\ServiceRequest;
use Illuminate\Http\UploadedFile;

class ServiceDTO
{
    public string $title;
    public string|null $description;
    public string $url;
    public int|null $parent_id;
    public UploadedFile|null $image;
    public bool $show_in_first_page;
    public bool $show_in_layout;
    public UploadedFile|null $header_image;
    public string|null $phone_number;
    public string|null $short_description;

    public static function fromRequest(ServiceRequest $request)
    {
        $self = new self();
        $self->title = $request->get('title');
        $self->description = $request->get('description');
        $self->url = trim(str_replace(' ', '-',$request->get('url')));
        $self->parent_id = $request->get('parent_id');
        $self->image = $request->file('image');
        $self->show_in_first_page = $request->has('show_in_first_page');
        $self->show_in_layout = $request->has('show_in_layout');
        $self->phone_number = $request->get('phone_number');
        $self->short_description = $request->get('short_description');
        $self->header_image = $request->file('header_image');
        return $self;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getParentId(): ?int
    {
        return $this->parent_id;
    }

    public function getImage(): ?UploadedFile
    {
        return $this->image;
    }

    public function isShowInFirstPage(): bool
    {
        return $this->show_in_first_page;
    }

    public function isShowInLayout(): bool
    {
        return $this->show_in_layout;
    }

    public function setShowInLayout(bool $show_in_layout): void
    {
        $this->show_in_layout = $show_in_layout;
    }
    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function getHeaderImage(): ?UploadedFile
    {
        return $this->header_image;
    }

}
