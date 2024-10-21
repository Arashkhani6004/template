<?php
namespace Rahweb\CmsCore\Modules\Page\Services;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\Page\DTO\PageDTO;
use Rahweb\CmsCore\Modules\Page\Entities\Page;
use Rahweb\CmsCore\Modules\Page\Http\Controllers\PageController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class PageService
{
    protected $model;

    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    public function create(PageDTO $pageDTO)
    {
        $image = $pageDTO->getImage() ? FileManager::upload($pageDTO->getImage(),"page") : null;
        $page = Page::create([
            'title' => $pageDTO->getTitle(),
            'description' => $pageDTO->getDescription(),
            'url' => $pageDTO->getUrl(),
            'parent_id' => $pageDTO->getParentId(),
            'image' => $image,
            'show_in_first_page' => $pageDTO->getShowInFirstPage(),
        ]);

    }
    public function update(int $id, PageDTO $pageDTO)
    {
        $page = Page::findOrfail($id);
        if ($pageDTO->getParentId() == $id){
            return redirect()->back()->with('error', 'نمیتوان این صفحه را زیرمجموعه خودش قرار داد ');

        }
        $image = $pageDTO->getImage() ? FileManager::upload($pageDTO->getImage(),"page") : $page->getRawOriginal('image');
        $page->update([
            'title' => $pageDTO->getTitle(),
            'description' => $pageDTO->getDescription(),
            'url' => $pageDTO->getUrl(),
            'parent_id' => $pageDTO->getParentId(),
            'image' => $image,
            'show_in_first_page' => $pageDTO->getShowInFirstPage(),
        ]);

    }
    public function destroy(int $id)
    {
        Page::destroy($id);
    }
}
