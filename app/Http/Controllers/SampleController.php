<?php

namespace App\Http\Controllers;

use App\Library\Assistant\Modules\V1\Portfolio;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Rahweb\CmsCore\Modules\Blog\Services\BlogService;
use Rahweb\CmsCore\Modules\Service\Services\ServiceManager;
use Rahweb\CmsCore\Modules\Service\Services\WorkSampleService;

class SampleController extends Controller
{
    public function index()
    {
        $samples = WorkSampleService::findAll([], 6);
        $query = ['list' => true];
        $services = ServiceManager::findAll($query, false);
        return view('pages.sample-list.index', compact('samples','services'));
    }
    public function getServiceForFilter(): JsonResponse
    {
        $query = ['list' => true];
        $services = ServiceManager::findAll($query, false);
        return response()->json([
            'data' => compact(
                'services'
            ),
            'success' => true,
        ]);
    }
    public function getListForVue(): JsonResponse
    {
        $query = [];
        $limit = 6;
        if (\request()->get('service_id') != null){
            $query = ['related' => true, 'specific_id' => \request()->get('service_id')];
            $limit = null;
        }
        $samples = WorkSampleService::findPaginate($query, $limit);
        $pageCount = $samples->lastPage();
        $currentPage = $samples->currentPage();
        return response()->json([
            'data' => compact(
                'samples',
                'pageCount',
                'currentPage',
            ),
            'success' => true,
        ]);
    }
    public function detail($url)
    {
      
        $sample = WorkSampleService::findOne($url);
        //related_samples
        $query = ['related' => true, 'specific_id' => $sample->services->pluck('id')->toArray()];
        $related_samples = WorkSampleService::findAll($query, null, $sample['id']);
        //related_blogs
        $query2 = ['sample' => true, 'specific_id' => $sample->services->pluck('id')->toArray()];
        $related_blogs = BlogService::findAll($query2);
        //comments
        $comments = $sample->comments;

        return view('pages.sample-detail.index', compact('sample', 'related_samples',
            'related_blogs', 'comments'));
    }
}
