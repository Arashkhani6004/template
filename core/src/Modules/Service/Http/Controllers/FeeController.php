<?php

namespace Rahweb\CmsCore\Modules\Service\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\Service\DTO\EditFeeDTO;
use Rahweb\CmsCore\Modules\Service\DTO\FeeDTO;
use Rahweb\CmsCore\Modules\Service\Entities\Fee;
use Rahweb\CmsCore\Modules\Service\Entities\Service;
use Rahweb\CmsCore\Modules\Service\Filters\FeeFilter;
use Rahweb\CmsCore\Modules\Service\Http\Requests\FeeRequest;
use Rahweb\CmsCore\Modules\Service\Services\FeeService;

class FeeController extends Controller
{
    protected $feeService;
    public function __construct(FeeService $feeService)
    {
        $this->feeService = $feeService;
    }
    public function index(Request $request)
    {
        $query = Fee::query();
        if ($request->has(['title'])) {
            $filters = [
                'title' => $request->input('title'),
            ];
            $query = app(FeeFilter::class)->apply($query, $filters);
        }
        $fee = $query->orderBy('id', 'DESC')->paginate(20);
        $services = Service::orderBy('id', 'DESC')->select(['title', 'id'])->get();
        $service = [];
        if ($request->get('service_id') != null) {
            $service = Service::findOrFail($request->get('service_id'));
            $fee = $query->orderBy('id', 'DESC')->where('service_id', $service->id)->paginate(30);
        }
        return view('CmsCore::service.fee.index', compact('fee', 'service', 'services'));
    }

    public function create(Request $request)
    {
        $service = Service::find($request->get('service_id'));
        $services = Service::orderBy('id', 'DESC')->select(['title', 'id'])->get();
        return view('CmsCore::service.fee.create', compact('services', 'service'));
    }

    public function store(FeeRequest $request)
    {
        $this->feeService->create(FeeDTO::fromRequest($request));
        if (FeeDTO::fromRequest($request)->getHasError() === true) {
            return redirect()->route('admin.fee.index')
                ->with('info', 'مقدار کمترین نرخ نباید از مقدار بیشترین نرخ بالاتر باشد یا یکی از موارد مقدار ندارد(مقادیر معتبر اضافه شدند)');
        } else {
            return redirect()->route('admin.fee.index')->with('success', 'آیتم جدید اضافه شد.');

        }

    }

    public function edit($id)
    {
        $data = Fee::findOrfail($id);
        $services = Service::orderBy('id', 'DESC')->select(['title', 'id'])->get();
        return view('CmsCore::service.fee.edit', compact('data', 'services'));
    }

    public function update(FeeRequest $request, $id)
    {
        $this->feeService->update($id, EditFeeDTO::fromRequest($request));
        return redirect()->route('admin.fee.index')->with('success', 'آیتم جدید اضافه شد.');
    }

    public function destroy($id)
    {
        //
        $this->feeService->destroy($id);
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }
}
