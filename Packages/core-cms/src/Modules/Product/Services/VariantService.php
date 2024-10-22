<?php

namespace Rahweb\CmsCore\Modules\Product\Services;

use Rahweb\CmsCore\Modules\Faq\Entities\Faq;
use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\General\Helper\NumberHelper;
use Rahweb\CmsCore\Modules\Product\DTO\MainVariantDTO;
use Rahweb\CmsCore\Modules\Product\DTO\VariantDTO;
use Rahweb\CmsCore\Modules\Product\Entities\ProductVariant;
use Rahweb\CmsCore\Modules\Product\Entities\Specification;
use Rahweb\CmsCore\Modules\Tag\Entities\Taggable;
use Rahweb\CmsCore\Modules\Product\DTO\SpfDTO;
use Rahweb\CmsCore\Modules\Product\DTO\VideoFaqDTO;
use Rahweb\CmsCore\Modules\Product\Entities\Brand;
use Rahweb\CmsCore\Modules\Product\Entities\Product;
use Rahweb\CmsCore\Modules\Product\Entities\Property;
use Rahweb\CmsCore\Modules\Product\Entities\Video;
use Rahweb\CmsCore\Modules\Product\Entities\ProductSpecification;

class VariantService
{
    public function createMain(MainVariantDTO $mainVariantDTO)
    {
        $product = Product::findOrFail($mainVariantDTO->getProductId());
        if ($product->main_variant_specification_id != $mainVariantDTO->getMainVariantSpecificationId()){
            $product->variants()->delete();
            $product->update([
                'main_variant_specification_id'=>$mainVariantDTO->getMainVariantSpecificationId()
            ]);
        }


    }
    public function create(VariantDTO $DTO)
    {
        foreach ($DTO->getDto()['variants'] as $variant){

            if ($variant['variant_id'] == null){
                ProductVariant::create([
                    'product_id'=>$DTO->getDto()['product_id'],
                    'specification_parent_id'=>$DTO->getDto()['specification_parent_id'],
                    'specification_id'=>$variant['specification_id'],
                    'price_affective'=>intval(@$variant['price_affective']),
                    'stock'=>intval(NumberHelper::persian2LatinDigit($variant['stock'])),
                    'price'=>intval(NumberHelper::persian2LatinDigit($variant['price'])),
                    'discounted_price'=>intval(NumberHelper::persian2LatinDigit($variant['discounted_price'])),
                    'final_price'=>intval(NumberHelper::persian2LatinDigit($variant['discounted_price'])) != 0 ?
                        intval(NumberHelper::persian2LatinDigit($variant['discounted_price'])) :
                        intval(NumberHelper::persian2LatinDigit($variant['price'])),
                ]);
            }
            else{

                $check = ProductVariant::findOrFail($variant['variant_id']);
                $check->update([
                    'specification_id'=>$variant['specification_id'],
                    'price_affective'=>intval(@$variant['price_affective']),
                    'stock'=>intval(NumberHelper::persian2LatinDigit($variant['stock'])),
                    'price'=>intval(NumberHelper::persian2LatinDigit($variant['price'])),
                    'discounted_price'=>intval(NumberHelper::persian2LatinDigit($variant['discounted_price'])),
                    'final_price'=>intval(NumberHelper::persian2LatinDigit($variant['discounted_price'])) != 0 ?
                        intval(NumberHelper::persian2LatinDigit($variant['discounted_price'])) :
                        intval(NumberHelper::persian2LatinDigit($variant['price'])),
                ]);
            }
        }
        $product = Product::findOrFail($DTO->getDto()['product_id']);
        $sum_stock = $product->variants()->orderBy('final_price','ASC')->sum('stock');
        $minimum_price_variant = $product->variants()
            ->orderByRaw('CAST(final_price AS UNSIGNED) ASC')
            ->where('stock', '<>', '0')
            ->first();
        $product->update(
     [
         'price'=>$minimum_price_variant['price'],
            'discounted_price'=>$minimum_price_variant['discounted_price'],
            'final_price'=>$minimum_price_variant['final_price'],
            'stock'=>$sum_stock,
         ]
    );
    }

    public function delete(int $id): void
    {
        $variant = ProductVariant::findOrFail($id);

        $variant->delete();
    }
    public static function getProductImagesSizeSeperated($images){
        $images_format = [];
        foreach($images as $image){
            $images_format[] =  [
                'id' => $image->id,
                'image_big' => $image->getImage('big'),
                'image_small' => $image->getImage('small'),
                'image_medium' => $image->getImage('medium'),
            ];
        }
        return $images_format;
    }

}
