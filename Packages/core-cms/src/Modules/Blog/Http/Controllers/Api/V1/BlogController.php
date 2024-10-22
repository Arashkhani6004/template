<?php

namespace Rahweb\CmsCore\Modules\Blog\Http\Controllers\Api\V1;

use Rahweb\CmsCore\Modules\Comment\Http\Resources\CommentCollection;
use Rahweb\CmsCore\Modules\Comment\Services\CommentService;
use Rahweb\CmsCore\Modules\Service\Http\Resources\ServiceCollection;
use Rahweb\CmsCore\Modules\Service\Services\ServiceManager;
use Rahweb\CmsCore\Modules\Blog\Http\Resources\BlogCategoryCollection;
use Rahweb\CmsCore\Modules\Blog\Http\Resources\BlogCollection;
use Rahweb\CmsCore\Modules\Blog\Services\BlogCategoryService;
use Rahweb\CmsCore\Modules\Blog\Services\BlogService;
use Illuminate\Http\JsonResponse;

class BlogController
{
    public function __construct(
        ServiceManager $serviceManager,
        BlogService $blogService,
        BlogCategoryService $blogCategoryService,
        CommentService $commentService,
    ) {
        $this->serviceManager = $serviceManager;
        $this->blogService = $blogService;
        $this->blogCategoryService = $blogCategoryService;
        $this->commentService = $commentService;
    }

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function getIndex(): JsonResponse
    {

        $found_blog_categories = $this->blogCategoryService->findAll();
        $blogCategoriesCollection = new BlogCategoryCollection($found_blog_categories);
        $blogCategoriesCollection->setHiddenFields(['description']);
        $blog_categories = $blogCategoriesCollection->toArray(request());

        return response()->json([
            'data' => compact(
                'blog_categories',
            ),
            'success' => true,
        ]);
    }
    public function getList($url): JsonResponse
    {

        $found_blog_category = $this->blogCategoryService->findOne($url);
        $blogCategoryCollection = new BlogCategoryCollection($found_blog_category);
        $blogCategoryCollection->setHiddenFields(['description', 'image']);
        $blog_category = $blogCategoryCollection->transformItemToArray($found_blog_category);
        $query = ['category' => true, 'specific_id' => $blog_category['id']];
        $blog_formatter = $this->blogService->findAll($query, false);
        $blogCollection = new BlogCollection($blog_formatter);
        $blogs = $blogCollection->toArray(request());

        return response()->json([
            'data' => compact(
                'blogs',
                'blog_category',
            ),
            'success' => true,
        ]);
    }
    public function getDetail($url): JsonResponse
    {
        $found_blog = $this->blogService->findOne($url);
        $this->blogService->updateView($found_blog['id']);
        $blogCollection = new BlogCollection([$found_blog]);
        $blog = $blogCollection->transformItemToArray($found_blog);
        //services
        $query = ['blog' => true, 'specific_id' => $found_blog['id']];
        $service_formatter = $this->serviceManager->findAll($query, false);
        $serviceCollection = new ServiceCollection($service_formatter);
        $serviceCollection->setHiddenFields(['children', 'samples', 'parent_url', 'description']);
        $services = $serviceCollection->toArray(request());
        //related_blogs
        $query2 = ['category' => true, 'specific_id' => $found_blog['parent_id']];
        $related_blog_formatter = $this->blogService->findAll($query2, $found_blog['id']);
        $relatedBlogCollection = new BlogCollection($related_blog_formatter);
        $relatedBlogCollection->setHiddenFields(['description']);
        $related_blogs = $relatedBlogCollection->toArray(request());
        //comments
        $comments = new CommentCollection($found_blog->comments);

        return response()->json([
            'data' => compact(
                'blog',
                'services',
                'related_blogs',
                'comments',
            ),
            'success' => true,
        ]);
    }

}
