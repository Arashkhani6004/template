<?php
namespace Rahweb\CmsCore\Modules\Tag\Services;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\Tag\DTO\TagDTO;
use Rahweb\CmsCore\Modules\Tag\Entities\Tag;
use Rahweb\CmsCore\Modules\Page\DTO\PageDTO;
use Rahweb\CmsCore\Modules\Page\Entities\Page;
use Rahweb\CmsCore\Modules\Page\Http\Controllers\PageController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class TagService
{

    public function create(TagDTO $tagDTO)
    {
        $image = $tagDTO->getImage() ? FileManager::upload($tagDTO->getImage(),"tag") : null;
        $banner = $tagDTO->getFirstPageImage() ? FileManager::upload($tagDTO->getFirstPageImage(),"tag") : null;
        $icon = $tagDTO->getFirstPageIcon() ? FileManager::upload($tagDTO->getFirstPageIcon(),"tag") : null;
        $tag = Tag::create([
            'title' => $tagDTO->getTitle(),
            'description' => $tagDTO->getDescription(),
            'url' => $tagDTO->getUrl(),
            'image' => $image,
            'first_page_image' => $banner,
            'first_page_icon' => $icon,
            'active' => $tagDTO->getActive(),
            'show_in_first_page' => $tagDTO->getShowFirstPage(),
        ]);

    }
    public function update(int $id, TagDTO $tagDTO)
    {
        $tag = Tag::findOrfail($id);
        $image = $tagDTO->getImage() ? FileManager::upload($tagDTO->getImage(),"tag") : $tag->getRawOriginal('image');
        $banner = $tagDTO->getFirstPageImage() ? FileManager::upload($tagDTO->getFirstPageImage(),"tag") : $tag->getRawOriginal('first_page_image');
        $icon = $tagDTO->getFirstPageIcon() ? FileManager::upload($tagDTO->getFirstPageIcon(),"tag") : $tag->getRawOriginal('first_page_icon');
        $tag->update([
            'title' => $tagDTO->getTitle(),
            'description' => $tagDTO->getDescription(),
            'url' => $tagDTO->getUrl(),
            'image' => $image,
            'first_page_image' => $banner,
            'first_page_icon' => $icon,
            'active' => $tagDTO->getActive(),
            'show_in_first_page' => $tagDTO->getShowFirstPage(),
        ]);

    }
    public function destroy(int $id)
    {
        Tag::destroy($id);
    }
    public static function findAll($query = [],  $except_id = null)
    {
        $tags = Tag::query();
        if ($except_id) {
            $tags->where('id', '<>', $except_id);
        }
        if (isset($query['first_page'])) {
            $tags->firstPage();
        }


      return $tags->orderby('id', 'DESC')->get();


    }
    public static function findOne($url)
    {
        return Tag::where('url',$url)->firstOrFail();
    }
}
