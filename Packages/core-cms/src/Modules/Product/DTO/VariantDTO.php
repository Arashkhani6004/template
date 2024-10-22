<?php

namespace Rahweb\CmsCore\Modules\Product\DTO;

use Rahweb\CmsCore\Modules\General\Helper\NumberHelper;
use Rahweb\CmsCore\Modules\Product\Http\Requests\SpecificationRequest;
use Rahweb\CmsCore\Modules\Product\Http\Requests\VariantRequest;

class VariantDTO
{
    protected string $specification_parent_id;
    public function getSpecificationParentId() : int
    {
        return $this->specification_parent_id;
    }
    protected string $product_id;
    public function getProductId() : int
    {
        return $this->product_id;
    }
   public function getVariants(): array|null
    {
        return $this->variants;
    }
    protected bool|null $has_error;
    public function getHasError(): bool|null
    {
        return $this->has_error;
    }
    private array $dto = [];

    public function getDto(): array
    {
        return $this->dto;
    }

//    public static function fromRequest(VariantRequest $request)
//    {
//        $self = new self();
//        $self->specification_parent_id = $request->get('specification_parent_id');
//        $self->product_id = $request->get('product_id');
//       $self->variants = $request->get('variants');
//        return $self;
//    }
    public static function fromRequest(VariantRequest $request)
    {
        $self = new self();
        $self->has_error = false;

        $self->dto = [
            'product_id' => $request->get('product_id'),
            'specification_parent_id' => $request->get('specification_parent_id'),
            'variants' => []
        ];

        foreach ($request['variants'] as $key => $item) {
            $discountedPrice =$item['discounted_price'] ? intval(NumberHelper::persian2LatinDigit($item['discounted_price'])) : 0;
            $price =$item['price'] ? intval(NumberHelper::persian2LatinDigit($item['price'])) : 0;



                if ($discountedPrice  != 0 && $discountedPrice >= $price ) {
                    $self->has_error = true;
                    continue;
                }

                $self->dto['variants'][] = [
                    'variant_id' => $item['variant_id'],
                    'specification_id' => $item['specification_id'],
                    'price_affective' => 1,
                    'stock' => intval(NumberHelper::persian2LatinDigit($item['stock'])),
                    'price' => $price,
                    'discounted_price' => $discountedPrice,
                ];

        }

        return $self;
    }


}
