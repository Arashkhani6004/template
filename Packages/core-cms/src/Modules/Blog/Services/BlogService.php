<?php
namespace Rahweb\CmsCore\Modules\Blog\Services;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\Blog\DTO\BlogDTO;
use Rahweb\CmsCore\Modules\Blog\Entities\Blog;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class BlogService
{
    protected $model;

    public function __construct(Blog $model)
    {
        $this->model = $model;
    }

    public function create(BlogDTO $blogDTO)
    {
        $image = $blogDTO->getImage() ? FileManager::upload($blogDTO->getImage(),"blog") : null;
        $blog = $this->model::create([
            'title' => $blogDTO->getTitle(),
            'url' => $blogDTO->getUrl(),
            'description' => $blogDTO->getDescription(),
            'parent_id' => $blogDTO->getParentId(),
            'image' => $image,
            'call_to_action' => $blogDTO->showCallToAction(),
            'author' => $blogDTO->getAuthor(),
            'publish_date' => $blogDTO->getPublishDate(),
        ]);
        $blog->services()->attach($blogDTO->getServices());

    }
    public function update(int $id, BlogDTO $blogDTO)
    {
        $blog = $this->model::findOrfail($id);
        $image = $blogDTO->getImage() ? FileManager::upload($blogDTO->getImage(),"blog") : $blog->getRawOriginal('image');
        $blog->update([
            'title' => $blogDTO->getTitle(),
            'url' => $blogDTO->getUrl(),
            'description' => $blogDTO->getDescription(),
            'parent_id' => $blogDTO->getParentId(),
            'image' => $image,
            'call_to_action' => $blogDTO->showCallToAction(),
            'author' => $blogDTO->getAuthor(),
            'publish_date' => $blogDTO->getPublishDate(),
        ]);
        $blog->services()->sync($blogDTO->getServices());

    }
    public function destroy(int $id)
    {

        Blog::destroy($id);
    }
    public static function findAll($query = [], $except_id = null)
    {
        $blogs = Blog::query();
        if ($except_id) {
            $blogs->where('id', '<>', $except_id);
        }
        if (isset($query['category'])) {
            $blogs->where('parent_id',$query['specific_id']);
        }
        if (isset($query['service'])) {
            $blogs->whereHas('services', function ($query2) use ($query) {
                $query2->where("service_id", $query['specific_id']);
            });
        }
        if (isset($query['sample'])) {
            $blogs->whereHas('services', function ($query2) use ($query) {
                $query2->whereIn("service_id", $query['specific_id']);
            });
        }

        $blogs = $blogs->orderby('id', 'DESC')
            ->where("publish_date", "<", Carbon::tomorrow()
                ->timezone('Asia/Tehran')->format("Y-m-d"))->get();
            return $blogs;

    }
    public static function findOne($url)
    {
        return Blog::where('url',$url)->where("publish_date", "<", Carbon::tomorrow()->timezone('Asia/Tehran')->format("Y-m-d"))->firstOrFail();

    }
    public static function updateView($id)
    {
        $blog = Blog::findOrfail($id);
        $blog->update([
            'view' => $blog['view']+1,
        ]);


    }
}
