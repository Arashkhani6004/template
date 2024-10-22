<?php

namespace Rahweb\CmsCore\Modules\Banner\DTO;

use Rahweb\CmsCore\Modules\Banner\Http\Requests\BannerRequest;
use Illuminate\Http\UploadedFile;

class BannerDTO
{
    protected string $title;
    protected UploadedFile|null $image;
    protected UploadedFile|null $image_mobile;
    protected int|null $show_in_first_page;
    public static function fromRequest(BannerRequest $request)
    {
        $self = new self();
        $self->title = $request->get('title');
        $self->image = $request->file('image');
        $self->image_mobile = $request->file('image_mobile');
        $self->show_in_first_page = $request->has('show_in_first_page') ? 1 : 0;
        return $self;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getImage(): ?UploadedFile
    {
        return $this->image;
    }

    public function getImageMobile(): ?UploadedFile
    {
        return $this->image_mobile;
    }

    public function setImage(?UploadedFile $image): void
    {
        $this->image = $image;
    }
    public function setImageMobile(?UploadedFile $image_mobile): void
    {
        $this->image_mobile = $image_mobile;
    }

    public function getShowInFirstPage(): ?int
    {
        return $this->show_in_first_page;
    }

    public function setShowInFirstPage(?int $show_in_first_page): void
    {
        $this->show_in_first_page = $show_in_first_page;
    }
}
