<?php
namespace Rahweb\CmsCore\Modules\Service\Services;

use Rahweb\CmsCore\Modules\General\Helper\FileUploader;
use Rahweb\CmsCore\Modules\Service\DTO\PackageDTO;
use Rahweb\CmsCore\Modules\Service\Entities\Package;

class PackageService
{
    public function create(PackageDTO $packageDTO)
    {
        $image = null;
        if ($packageDTO->getImage()) {
            $uploader = new FileUploader($packageDTO->getImage(), "uploads/package");
            $uploader->setExtensions(["jpeg", "webp", "png", "jpg"]);
            $uploader->setSizes(["big" => [400, 180]]);
            $image = $uploader->upload();
        }
        $package = Package::create([
            'title' => $packageDTO->getTitle(),
            'description' => $packageDTO->getDescription(),
            'show_in_first_page' => $packageDTO->getShowInFirstPage(),
            'url' => $packageDTO->getUrl(),
            'image' => $image,
            'price' => $packageDTO->getPrice(),
            'discounted_price' => $packageDTO->getDiscountedPrice(),

        ]);
        //relations
        $package->services()->attach($packageDTO->getServices());

    }
    public function update(int $id, PackageDTO $packageDTO)
    {
        $package = Package::findOrfail($id);
        $image = $package->getRawOriginal('image');
        if ($packageDTO->getImage()) {
            $uploader = new FileUploader($packageDTO->getImage(), "uploads/package");
            $uploader->setExtensions(["jpeg", "webp", "png", "jpg"]);
            $uploader->setSizes(["big" => [400, 180]]);
            $image = $uploader->upload();
        }
        $package->update([
            'title' => $packageDTO->getTitle(),
            'description' => $packageDTO->getDescription(),
            'show_in_first_page' => $packageDTO->getShowInFirstPage(),
            'url' => $packageDTO->getUrl(),
            'image' => $image,
            'price' => $packageDTO->getPrice(),
            'discounted_price' => $packageDTO->getDiscountedPrice(),

        ]);
        //relations
        $package->services()->attach($packageDTO->getServices());
    }
    public function destroy(int $id)
    {
        Package::destroy($id);
    }
    public static function findAll($query=[], $limit = null)
    {
        $data = Package::query();
        if (isset($query['first_page'])) {
            $data->firstPage();
        }
        if ($limit != null){
            return $data->take($limit)->orderBy('id','DESC')->get();
        }else{
            return $data->orderBy('id','DESC')->get();
        }
    }
    public static function findOne($url)
    {
        return Package::where('url',$url)->firstOrFail();

    }
}
