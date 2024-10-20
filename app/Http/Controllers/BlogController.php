<?php

namespace App\Http\Controllers;

use App\Library\Assistant\Modules\V1\Blog;
use Illuminate\Routing\Controller;
use Rahweb\CmsCore\Modules\Blog\Services\BlogCategoryService;
use Rahweb\CmsCore\Modules\Blog\Services\BlogService;
use Rahweb\CmsCore\Modules\Service\Services\ServiceManager;

class BlogController extends Controller
{
    public function index()
    {
        $blog_categories = BlogCategoryService::findAll(['list'=>1]);
        $blogs = [];
        return view('pages.blog-category.index', compact(
            'blog_categories','blogs'
        ));
    }
    public function list($url)
    {
        $blog_category = BlogCategoryService::findOne($url);

        if ($blog_category['parent_id'] == null){
            $query = ['parent_id' => $blog_category['id']];
            $blog_categories = BlogCategoryService::findAll($query);
            $query2 = ['specific_id' => $blog_category['id'],'category'=>true];
            $blogs = BlogService::findAll($query2);
            return view('pages.blog-category.index', compact(
                'blog_categories','blog_category','blogs'
            ));
        }else{
            $query = ['specific_id' => $blog_category['id'],'category'=>true];
            $blogs = BlogService::findAll($query);
            return view('pages.blog-list.index', compact(
                'blogs',
                'blog_category',
            ));
        }

    }
    public function detail($url)
    {

        $blog = BlogService::findOne($url);
        //update_view
        $blog->timestamps = false;
        $blog->increment('view');
        $blog->timestamps = true;
        //services
        $query = ['blog' => true, 'specific_id' => $blog['id']];
        $services = ServiceManager::findAll($query,false);
        //related_blogs
        $query2 = ['category' => true, 'specific_id' => $blog['parent_id']];
        $related_blogs = BlogService::findAll($query2,$blog->id);
        //comments
        $comments = $blog->comments;
        return view('pages.blog-detail.index',
            compact('blog', 'services', 'related_blogs',
                'comments'
            ));

    }
}
