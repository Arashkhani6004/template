<?php

namespace Rahweb\CmsCore\Modules\Banner\Services;

use Rahweb\CmsCore\Modules\General\Helper\FileUploader;
use Rahweb\CmsCore\Modules\Banner\DTO\BannerDTO;
use Rahweb\CmsCore\Modules\Banner\Entities\Banner;

class BannerService
{
    public function create(BannerDTO $bannerDTO)
    {
        $image = null;
        if ($bannerDTO->getImage()) {
            $uploader = new FileUploader($bannerDTO->getImage(), "uploads/banner");
            $uploader->setExtensions(["jpeg", "webp", "png", "jpg"]);
            $uploader->setSizes(["big" => [2000, 1000]]);
            $image = $uploader->upload();
        }
        $image_mobile = null;
        if ($bannerDTO->getImageMobile()) {
            $uploader = new FileUploader($bannerDTO->getImageMobile(), "uploads/banner");
            $uploader->setExtensions(["jpeg", "webp", "png", "jpg"]);
            $uploader->setSizes(["big" => [750, 1125]]);
            $image_mobile = $uploader->upload();
        }
        Banner::create([
            'image' => $image,
            'image_mobile' => $image_mobile,
            'title' => $bannerDTO->getTitle(),
            'show_in_first_page' => $bannerDTO->getShowInFirstPage(),
        ]);
    }

    public function update(int $id, BannerDTO $bannerDTO)
    {
        $banner = Banner::findOrfail($id);
        $image = $banner->getRawOriginal('image');
        if ($bannerDTO->getImage()) {
            $uploader = new FileUploader($bannerDTO->getImage(), "uploads/banner");
            $uploader->setExtensions(["jpeg", "webp", "png", "jpg"]);
            $uploader->setSizes(["big" => [2000, 1000]]);
            $image = $uploader->upload();
        }
        $image_mobile = $banner->getRawOriginal('image_mobile');
        if ($bannerDTO->getImageMobile()) {
            $uploader = new FileUploader($bannerDTO->getImageMobile(), "uploads/banner");
            $uploader->setExtensions(["jpeg", "webp", "png", "jpg"]);
            $uploader->setSizes(["big" => [750, 1125]]);
            $image_mobile = $uploader->upload();
        }
        $banner->update([
            'title' => $bannerDTO->getTitle(),
            'image_mobile' => $image_mobile,
            'image' => $image,
            'show_in_first_page' => $bannerDTO->getShowInFirstPage(),
        ]);
    }

    public function destroy(int $id)
    {
        Banner::destroy($id);
    }

    public static function findAll($query, $limit = 10)
    {
        $data = Banner::query();
        if (isset($query['first_page'])) {
            $data->firstPage();
        }
        return $data->take($limit)->get();
    }

}
