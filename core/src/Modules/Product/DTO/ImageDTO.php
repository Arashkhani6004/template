<?php

namespace Rahweb\CmsCore\Modules\Product\DTO;
use Rahweb\CmsCore\Modules\Service\Http\Requests\WorkSampleRequest;
use Rahweb\CmsCore\Modules\Product\Http\Requests\ImageRequest;
use Illuminate\Http\UploadedFile;

class ImageDTO
{


    protected UploadedFile|array $images;

    public function getImage(): UploadedFile|array
    {
        return $this->images;
    }
    protected string $product_id;
    public function getProductId() : int
    {
        return $this->product_id;
    }
    protected string $specification_id;
    public function getSpecifications() : array|null
    {
        return $this->specifications;
    }

    public static function fromRequest(ImageRequest $request)
    {
        $self = new self();
        $self->images = $request->file('image') == null ? [] : $request->file('image');
        $self->product_id = trim($request->get('product_id'));
        $self->specifications = $request->get('specification_id');
        return $self;
    }
}
