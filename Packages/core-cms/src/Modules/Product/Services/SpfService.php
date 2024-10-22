<?php

namespace Rahweb\CmsCore\Modules\Product\Services;

use Rahweb\CmsCore\Modules\Faq\Entities\Faq;
use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\Product\Entities\Specification;
use Rahweb\CmsCore\Modules\Tag\Entities\Taggable;
use Rahweb\CmsCore\Modules\Product\DTO\SpfDTO;
use Rahweb\CmsCore\Modules\Product\DTO\VideoFaqDTO;
use Rahweb\CmsCore\Modules\Product\Entities\Brand;
use Rahweb\CmsCore\Modules\Product\Entities\Product;
use Rahweb\CmsCore\Modules\Product\Entities\Property;
use Rahweb\CmsCore\Modules\Product\Entities\Video;
use Rahweb\CmsCore\Modules\Product\Entities\ProductSpecification;

class SpfService
{
    public function create(SpfDTO $DTO)
    {
        $product = Product::findOrFail($DTO->getProductId());
        Taggable::where('taggable_id', $product['id'])->where('taggable_type', 'Rahweb\CmsCore\Modules\Product\Entities\Product')->delete();
        if ($DTO->getTags() != null) {
            foreach ($DTO->getTags() as $tag) {
                Taggable::create([
                    'tag_id' => $tag,
                    'taggable_id' => $DTO->getProductId(),
                    'taggable_type' => 'Rahweb\CmsCore\Modules\Product\Entities\Product',
                ]);
            }
        }


        if ($DTO->getProprties() != null) {
            foreach ($DTO->getProprties() as $proprty) {
                if ($proprty['value'] != null) {
                    if ($proprty['property_id'] == null) {
                        Property::create([
                            'value' => $proprty['value'],
                            'product_id' => $DTO->getProductId(),
                        ]);
                    } else {
                        $check = Property::findOrFail($proprty['property_id']);
                        $check->update([
                            'value' => $proprty['value'],
                        ]);
                    }
                }

            }
        }
        if ($DTO->getSpecificationProductValues() != null) {
            foreach ($DTO->getSpecificationProductValues() as $texts) {

                foreach ($texts as $text) {
                if ($text['value'] != null) {
                    if ($text['product_value_id'] == null) {
                        ProductSpecification::create([
                            'value' => $text['value'],
                            'specification_id' => $text['specification_id'],
                            'product_id' => $DTO->getProductId(),
                        ]);
                    } else {
                        $check = ProductSpecification::findOrFail($text['product_value_id']);
                        $check->update([
                            'value' => $text['value'],
                        ]);
                    }
                }

            }
            }
        }
        ProductSpecification::where('product_id', $product['id'])->whereNull('value')->delete();

        if ($DTO->getSpecifications() != null) {
            foreach ($DTO->getSpecifications() as $specification) {
                $specification_parent_id = Specification::find($specification)->parent_id;
                ProductSpecification::create([
                    'specification_id' => $specification,
                    'product_id' => $DTO->getProductId(),
                    'parent_id' => @$specification_parent_id,
                ]);
            }
        }


    }

    public function deleteProperty(int $id): void
    {
        $property = Property::findOrFail($id);
        $property->delete();
    }

    public function deleteSpecification(int $id): void
    {
        $specification = ProductSpecification::findOrFail($id);
        $specification->delete();
    }


}
