<?php

namespace Rahweb\CmsCore\Modules\Service\Http\Controllers;

use Rahweb\CmsCore\Modules\General\Helper\CacheHelper;
use Rahweb\CmsCore\Modules\Service\DTO\ServiceDTO;
use Rahweb\CmsCore\Modules\Service\Entities\Service;
use Rahweb\CmsCore\Modules\Service\Filters\ServiceFilter;
use Rahweb\CmsCore\Modules\Service\Http\Requests\ServiceRequest;
use Rahweb\CmsCore\Modules\Service\Services\ServiceManager;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;

class ServiceController extends Controller
{
    protected ServiceManager $serviceManager;
    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    public function index(Request $request)
    {
        $query = Service::query();
        if ($request->hasAny(['title', 'parent_id'])) {
            $filters = [
                'title' => $request->get('title'),
                'parent_id' => $request->get('parent_id'),
            ];
            $query = app(ServiceFilter::class)->apply($query, $filters);
        }
        $services = $query->get();
        $services = $this->serviceManager->formatServices($services, 15);
        $all_services = $this->serviceManager->findAll();
        return view('CmsCore::service.service.index', compact('services', 'all_services'));
    }

    public function create()
    {
        $services = $this->serviceManager->findAll();
        CacheHelper::clearCache();
        return view('CmsCore::service.service.create', compact('services'));
    }

    public function store(ServiceRequest $request)
    {
        $this->serviceManager->create(ServiceDTO::fromRequest($request));
        CacheHelper::clearCache();
        return redirect()->route('admin.service.index')->with('success', 'آیتم جدید اضافه شد.');
    }

    public function edit(int $id)
    {
        $data = Service::findOrFail($id);
        $services = $this->serviceManager->findAll($id);
        return view('CmsCore::service.service.edit', compact('data', 'services'));
    }

    public function update(ServiceRequest $request, int $id)
    {
        $this->serviceManager->update($id, ServiceDTO::fromRequest($request));
        CacheHelper::clearCache();
        return redirect()->route('admin.service.index')->with('success', 'آیتم ویرایش شد.');
    }

    public function destroy($id)
    {
        $this->serviceManager->deleteOne($id);
        CacheHelper::clearCache();
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }

    public function deleteRoot($id)
    {
        $this->serviceManager->deleteRoot($id);
        CacheHelper::clearCache();
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }
}
