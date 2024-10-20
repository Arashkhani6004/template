@extends('pages.panel.master')
@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/panel/panel.css?v.1')}}">
@endpush
@section('content')
<div class="header p-3">
    <p class="font-md m-0 d-flex align-items-center h3">
        <i class="bi bi-columns-gap me-2 d-flex"></i>
        پکیج های من
    </p>
</div>
<div class="content px-xl-3 py-2">
    <div class="packages">
        <div class="row w-100 m-0">
            <div class="col-xxl-4 col-sm-6 p-1">
                <div class="item-package shadow-sm">
                    <img src="assets/site/images/package1.webp" class="w-100" alt="package" title="package" loading="lazy">
                    <hr class="my-1">
                    <p class="font-bold m-0 text-center my-2">
                        پکیج فرمالیته با پرسنل
                    </p>
                    <a href="#" class="btn btn-one w-100 py-2 text-center d-flex align-items-center justify-content-center">
                        <i class="bi bi-eye d-flex me-2"></i>
                        مشاهده پکیج
                    </a>
                </div>
            </div>
            <div class="col-xxl-4 col-sm-6 p-1">
                <div class="item-package shadow-sm">
                    <img src="assets/site/images/package2.webp" class="w-100" alt="package" title="package" loading="lazy">
                    <hr class="my-1">
                    <p class="font-bold m-0 text-center my-2">
                        پکیج فرمالیته با پرسنل
                    </p>
                    <a href="#" class="btn btn-one w-100 py-2 text-center d-flex align-items-center justify-content-center">
                        <i class="bi bi-eye d-flex me-2"></i>
                        مشاهده پکیج
                    </a>
                </div>
            </div>
            <div class="col-xxl-4 col-sm-6 p-1">
                <div class="item-package shadow-sm">
                    <img src="assets/site/images/package3.webp" class="w-100" alt="package" title="package" loading="lazy">
                    <hr class="my-1">
                    <p class="font-bold m-0 text-center my-2">
                        پکیج فرمالیته با پرسنل
                    </p>
                    <a href="#" class="btn btn-one w-100 py-2 text-center align-items-center d-flex justify-content-center">
                        <i class="bi bi-eye d-flex me-2"></i>
                        مشاهده پکیج
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection