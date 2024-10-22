<?php

namespace Rahweb\CmsCore\Modules\Product\DTO;
use Rahweb\CmsCore\Modules\Product\Http\Requests\MainVariantRequest;

class MainVariantDTO
{

    protected string $main_variant_specification_id;
    public function getMainVariantSpecificationId() : int
    {
        return $this->main_variant_specification_id;
    }
    protected string $product_id;
    public function getProductId() : int
    {
        return $this->product_id;
    }
    public static function fromRequest(MainVariantRequest $request)
    {
        $self = new self();
        $self->main_variant_specification_id = $request->get('main_variant_specification_id');
        $self->product_id = $request->get('product_id');
        return $self;
    }
}
