<?php
namespace Rahweb\CmsCore\Modules\Product\Services;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\Product\DTO\BrandDTO;
use Rahweb\CmsCore\Modules\Product\Entities\Brand;

class BrandService
{
    public function create(BrandDTO $brandDTO)
    {
        $image = $brandDTO->getImage() ? FileManager::upload($brandDTO->getImage(),"brand") : null;
        $brand = Brand::create([
            'title' => $brandDTO->getTitle(),
            'description' => $brandDTO->getDescription(),
            'url' => $brandDTO->getUrl(),
            'image' => $image,
            'active' => $brandDTO->getActive(),
        ]);

    }
    public function update(int $id, BrandDTO $brandDTO)
    {
        $brand = Brand::findOrfail($id);
        $image = $brandDTO->getImage() ? FileManager::upload($brandDTO->getImage(),"brand") : $brand->getRawOriginal('image');
        $brand->update([
            'title' => $brandDTO->getTitle(),
            'description' => $brandDTO->getDescription(),
            'url' => $brandDTO->getUrl(),
            'image' => $image,
            'active' => $brandDTO->getActive(),
        ]);

    }

    public function deleteOne(int $id): void
    {
        $brand = Brand::findOrFail($id);

        //delete image
        if ($brand->image) {
            FileManager::delete("brand/" . $brand->getRawOriginal('image'));
        }
        $brand->delete();
    }

    //
    public static function findAll($query = [], $except_id = null, $limit = null)
    {
        $brands = Brand::query();
        if ($except_id) {
            $brands->where('id', '<>', $except_id);
        }
        if (isset($query['first_page'])) {
            $brands->firstPage();
        }
        if (isset($query['layout'])) {
            $brands->where('show_in_layout',1);
        }
        if (isset($query['filter_brands'])) {
            $brands->whereIn('id',$query['filter_brands']);
        }
        if (isset($query['title'])) {
            $brands->where('title','LIKE','%'.$query['title'].'%');
        }
        if ($limit != null) {
            return $brands->orderby('id', 'DESC')->take($limit)->get();
        }else{
            return $brands->orderby('id', 'DESC')->get();
        }
    }
    public static function findOne($url)
    {
        return Brand::where('url',$url)->firstOrFail();
    }


}
