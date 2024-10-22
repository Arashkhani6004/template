<?php

namespace Rahweb\CmsCore\Modules\Product\Services;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\General\Helper\FileUploader;
use Rahweb\CmsCore\Modules\Product\Entities\Product;
use Rahweb\CmsCore\Modules\Service\Entities\Service;
use Rahweb\CmsCore\Modules\Service\DTO\WorkSampleDTO;
use Rahweb\CmsCore\Modules\Service\Entities\WorkSample;
use Rahweb\CmsCore\Modules\Service\Entities\WorkSampleImage;
use Rahweb\CmsCore\Modules\Product\DTO\ImageDTO;
use Rahweb\CmsCore\Modules\Product\Entities\Image;

class ImageService
{
    public function create(ImageDTO $imageDTO): void
    {

        foreach ($imageDTO->getImage() as $item) {
            $image = null;
            if ($item) {
                $uploader = new FileUploader($item, "uploads/product");
                $uploader->setExtensions(["jpeg", "webp", "png", "jpg"]);
                $uploader->setSizes(
                    [
                        "big" => [1000, 1000],
                        "medium" => [500, 500],
                        "small" => [75, 75],
                    ]
                );
                $image = $uploader->upload();
            }
            Image::create([
                'image' => $image,
                'product_id' => $imageDTO->getProductId(),
            ]);
        }
        $product = Product::findOrFail($imageDTO->getProductId());
        $product->update([
            'image' => count($product->images) > 0 ? @$product->images[0]->image : null,
        ]);
        if ($imageDTO->getSpecifications()) {
            foreach ($imageDTO->getSpecifications() as $key => $specification) {
                Image::findOrFail($key)->update(
                    ['specification_id' => $specification]
                );
            }
        }
    }
}
