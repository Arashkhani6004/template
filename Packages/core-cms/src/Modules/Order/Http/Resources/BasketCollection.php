<?php

namespace Rahweb\CmsCore\Modules\Order\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Rahweb\CmsCore\Modules\Product\Services\VariantService;

class BasketCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Rahweb\CmsCore\Modules\Order\Entities\Basket
     *
     */
    public function __construct($collection)
    {
        parent::__construct($collection);


    }

    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'success' => true,
                    'id' => @$item->id,
                    'product_title' => @$item->product->title,
                    'product_id' => $item->product_id,
                    'product_image' => @$item->product_variant_id ? (VariantService::getProductImagesSizeSeperated(@$item->productVariant->images)[0]['image_medium'] ?? @$item->product->getImage()) : @$item->product->getImage(),
                    'product_final_price' => @$item->product_variant_id
                        ? number_format(intval(@$item->productVariant->final_price)) . ' تومان '
                        : number_format(intval(@$item->product->final_price)) . ' تومان ',
                    'product_price' =>$item->product_variant_id ?
                        (intval($item->productVariant->discounted_price) != 0 ? number_format(intval(@$item->productVariant->price)) . ' تومان '  : 0) :
                        (intval($item->product->discounted_price) != 0 ?  number_format(intval(@$item->product->price)) . ' تومان ' : 0),
                    'main_variant_title' => @$item->product->main_variant_specification_id != null ? @$item->product->mainVariant->title : '',
                    'variant_title' => @$item->product_variant_id ? @$item->productVariant->specification->title : '',
                    'variant_id' => @$item->product_variant_id,
                    'variant_color' => (@$item->product->main_variant_specification_id && @$item->product->mainVariant->is_color == 1) ?
                        @$item->productVariant->specification->color_code : '',
                    'brand_title' => @$item->product->brand->title,
                    'product_url' => route('product.detail', ['url' => @$item->product->url]),
                    'quantity' => @$item->quantity,
                    'percent' => @$item->product_variant_id ? @$item->productVariant->percent : @$item->product->percent,
                ];
            }),
            'status' => 200,
        ];
    }

}
