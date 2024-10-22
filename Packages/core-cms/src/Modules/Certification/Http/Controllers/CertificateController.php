<?php

namespace Rahweb\CmsCore\Modules\Certification\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\Certification\DTO\CertificateDTO;
use Rahweb\CmsCore\Modules\Certification\Entities\Certificate;
use Rahweb\CmsCore\Modules\Certification\Filters\CertificateFilter;
use Rahweb\CmsCore\Modules\Certification\Http\Requests\CertificateRequest;
use Rahweb\CmsCore\Modules\Certification\Services\CertificateService;
use Rahweb\CmsCore\Modules\General\Helper\CacheHelper;

class CertificateController extends Controller
{
    protected $certificateService;
    public function __construct(CertificateService $certificateService)
    {
        $this->certificateService = $certificateService;
    }
    public function index(Request $request)
    {
        $query = Certificate::query();
        if ($request->has(['title'])) {
            $filters = [
                'title' => $request->input('title'),
            ];
            $query = app(CertificateFilter::class)->apply($query, $filters);
        }
        $certificate = $query->orderByDesc('id')->paginate(20);
        return view('CmsCore::certification.index', compact('certificate'));

    }

    public function create()
    {
        return view('CmsCore::certification.create');
    }

    public function store(CertificateRequest $request)
    {
        $this->certificateService->create(CertificateDTO::fromRequest($request));
        CacheHelper::clearCache();
        return redirect()->route('admin.certificate.index')
            ->with('success', 'گواهی جدید اضافه شد.');

    }

    public function edit($id)
    {
        $data = Certificate::findOrfail($id);
        return view('CmsCore::certification.edit', compact('data'));
    }

    public function update(CertificateRequest $request, $id)
    {
        $this->certificateService->update($id, CertificateDTO::fromRequest($request));
        CacheHelper::clearCache();
        return redirect()->route('admin.certificate.index')
            ->with('success', 'گواهی ویرایش شد.');
    }

    public function destroy($id)
    {
        $this->certificateService->destroy($id);
        CacheHelper::clearCache();
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }
}
