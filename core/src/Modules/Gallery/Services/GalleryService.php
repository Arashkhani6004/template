<?php
namespace Rahweb\CmsCore\Modules\Gallery\Services;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\Gallery\DTO\GAlleryDTO;
use Rahweb\CmsCore\Modules\Gallery\Entities\Gallery;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class GalleryService
{
    public function create(GalleryDTO $galleryDTO)
    {
        $image = $galleryDTO->getFile() ? FileManager::upload($galleryDTO->getFile(),"gallery") : null;
        Gallery::create([
            'title' => $galleryDTO->getTitle(),
            'parent_id' => $galleryDTO->getParentId(),
            'show_in_first_page' => $galleryDTO->getShowInFirstPage(),
            'description' => $galleryDTO->getDescription(),
            'file' => $image,
        ]);

    }
    public function update(int $id, GalleryDTO $galleryDTO)
    {
        $gallery = Gallery::findOrfail($id);
        $image = $galleryDTO->getFile() ? FileManager::upload($galleryDTO->getFile(),"gallery") : $gallery->getRawOriginal('file');
        $gallery->update([
            'title' => $galleryDTO->getTitle(),
            'parent_id' => $galleryDTO->getParentId(),
            'show_in_first_page' => $galleryDTO->getShowInFirstPage(),
            'description' => $galleryDTO->getDescription(),
            'file' => $image,
        ]);
    }
    public function destroy(int $id)
    {
        Gallery::destroy($id);
    }
    public function findInFirstPage($paginate = 6)
    {
        return Gallery::firstPage()->take($paginate)->get();
    }
    public static function findAll($query, $limit = 10)
    {
        $data = Gallery::query();
        if (isset($query['first_page'])) {
            $data->firstPage();
        }
        return $data->take($limit)->get();
    }
}
