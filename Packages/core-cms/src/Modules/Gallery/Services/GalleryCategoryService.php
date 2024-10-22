<?php

namespace Rahweb\CmsCore\Modules\Gallery\Services;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\Gallery\DTO\GalleryCategoryDTO;
use Rahweb\CmsCore\Modules\Gallery\Entities\GalleryCategory;

class GalleryCategoryService
{
    public function create(GalleryCategoryDTO $galleryCategoryDTO)
    {
        $image = $galleryCategoryDTO->getImage() ? FileManager::upload($galleryCategoryDTO->getImage(), "gallery-category") : null;
        $category = GalleryCategory::create([
            'title' => $galleryCategoryDTO->getTitle(),
            'url' => $galleryCategoryDTO->getUrl(),
            'show_in_first_page' => $galleryCategoryDTO->getShowInFirstPage(),
            'image' => $image,
        ]);

    }

    public function update(int $id, GalleryCategoryDTO $galleryCategoryDTO)
    {
        $category = GalleryCategory::findOrfail($id);
        $image = $galleryCategoryDTO->getImage() ? FileManager::upload($galleryCategoryDTO->getImage(), "gallery-category") : $category->getRawOriginal('image');
        $category->update([
            'title' => $galleryCategoryDTO->getTitle(),
            'url' => $galleryCategoryDTO->getUrl(),
            'show_in_first_page' => $galleryCategoryDTO->getShowInFirstPage(),
            'image' => $image,
        ]);

    }

    public function destroy(int $id)
    {
        GalleryCategory::destroy($id);
    }

    public static function findAll($query = [], $limit = null, $except_id = null)
    {
        $data = GalleryCategory::query();
        if ($except_id) {
            $data->where('id', '<>', $except_id);
        }
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
        return GalleryCategory::where('url',$url)->firstOrFail();
    }
}
