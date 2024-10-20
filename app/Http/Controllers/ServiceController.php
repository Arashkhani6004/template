<?php

namespace App\Http\Controllers;

use App\Library\Assistant\Modules\V1\Service;
use Illuminate\Routing\Controller;
use Rahweb\CmsCore\Modules\Blog\Services\BlogService;
use Rahweb\CmsCore\Modules\Service\Services\ServiceManager;
use Rahweb\CmsCore\Modules\Service\Services\WorkSampleService;

class ServiceController extends Controller
{
    public function index()
    {
        $query = ['list' => true];
        $services = ServiceManager::findAll($query, false);
        return view('pages.service-list.index', compact(
            'services'
        ));
    }

    public function detail($url)
    {
        $service = ServiceManager::findOne($url);
        if (count($service->children) > 0) {
            $services = $service->children;
            return view('pages.service-list.index', compact('service', 'services'));
        } else {
            //blogs
            $query = ['service' => true, 'specific_id' => $service['id']];
            $blogs = BlogService::findAll($query, false);
            //related_service
            $query2 = ['related' => true, 'parent_id' => $service['parent_id']];
            $related_services = ServiceManager::findAll($query2, false, $service['id']);
            //samples
            $query3 = ['related' => true, 'specific_id' => $service['id']];
            $samples = WorkSampleService::findAll($query3);
            //comments
            $comments = $service->comments;
            $fees = $service->fees;
            return view('pages.service-detail.index',
                compact('service', 'blogs', 'related_services',
                    'samples', 'comments', 'fees'
                ));
        }
    }
}
