<?php

namespace Rahweb\CmsCore\Modules\Service\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\General\Helper\MakeTree;
use Rahweb\CmsCore\Modules\Service\DTO\PackageDTO;
use Rahweb\CmsCore\Modules\Service\Entities\Package;
use Rahweb\CmsCore\Modules\Service\Entities\Service;
use Rahweb\CmsCore\Modules\Service\Filters\PackageFilter;
use Rahweb\CmsCore\Modules\Service\Http\Requests\PackageRequest;
use Rahweb\CmsCore\Modules\Service\Services\PackageService;

class PackageController extends Controller
{
    protected $packageService;
    public function __construct(PackageService $packageService)
    {
        $this->packageService = $packageService;
    }

    public function index(Request $request)
    {
        $query = Package::query();
        if ($request->has(['title', 'parent_id'])) {
            $filters = [
                'title' => $request->input('title'),
            ];
            $query = app(PackageFilter::class)->apply($query, $filters);
        }
        $package = $query->orderByDesc('id')->paginate(20);
        return view('CmsCore::service.package.index', compact('package'));

    }

    public function create()
    {
        $services = Service::all()->toArray();
        if (!empty($services)) {
            MakeTree::getData($services);
            $services = MakeTree::GenerateArray(array('get'));
        }
        return view('CmsCore::service.package.create', compact('services'));
    }

    public function store(PackageRequest $request)
    {
        //
        $this->packageService->create(PackageDTO::fromRequest($request));
        return redirect()->route('admin.package.index')
            ->with('success', 'پکیج جدید اضافه شد.');
    }

    public function edit($id)
    {
        $data = Package::findOrfail($id);
        $services = Service::all()->toArray();
        if (!empty($services)) {
            MakeTree::getData($services);
            $services = MakeTree::GenerateArray(array('get'));
        }
        return view('CmsCore::service.package.edit', compact('data', 'services'));
    }

    public function update(PackageRequest $request, $id)
    {
        //
        $this->packageService->update($id, PackageDTO::fromRequest($request));
        return redirect()->route('admin.package.index')
            ->with('success', 'پکیج ویرایش شد.');
    }

    public function destroy($id)
    {
        //
        $this->packageService->destroy($id);
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }
}
