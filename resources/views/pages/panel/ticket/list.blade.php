@extends('pages.panel.master')
@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/panel/panel.css?v.1')}}">
@endpush
@section('content')
<div class="header p-3">
    <p class="font-md m-0 d-flex align-items-center h3">
        <i class="bi bi-mailbox me-2 d-flex"></i>
        تیکت ها <span class="font-num-r">(5)</span>
    </p>
</div>
<div class="content px-xl-3 py-2">
    <div class="tickets p-2">
        <div class="header border-bottom mb-2">
            <div class="row w-100 m-0">
                <div class="col-1 p-1 text-center">
                    <p class="font-bold font-small m-0">شماره</p>
                </div>
                <div class="col p-1 text-center">
                    <p class="font-bold font-small m-0">عنوان</p>
                </div>
                <div class="col p-1 text-center">
                    <p class="font-bold font-small m-0">وضعیت</p>
                </div>
                <div class="col-1 p-1 text-center d-md-block d-none">
                    <p class="font-bold font-small m-0">نمایش</p>
                </div>
            </div>
        </div>
        <div class="item">
            <a href="#" class="font-re small m-0 d-block">
                <div class="row w-100 m-0">
                    <div class="col-1 p-1 text-center align-self-center">
                        <p class="font-re small m-0">
                            1
                        </p>
                    </div>
                    <div class="col p-1 text-center align-self-center">
                        <p class="font-re small m-0">
                            عنوان تستی شماره یک
                        </p>
                    </div>
                    <div class="col p-1 text-center align-self-center">
                        <span class="badge bg-transparent border-success border text-success font-re fw-light">
                            پاسخ داده شده
                        </span>
                    </div>
                    <div class="col-md-1 p-1 text-center align-self-center d-md-block d-none">
                        <i class="bi bi-chevron-left"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="item">
            <a href="#" class="font-re small m-0 d-block">
                <div class="row w-100 m-0">
                    <div class="col-1 p-1 text-center align-self-center">
                        <p class="font-re small m-0">
                            1
                        </p>
                    </div>
                    <div class="col p-1 text-center align-self-center">
                        <p class="font-re small m-0">
                            عنوان تستی شماره یک
                        </p>
                    </div>
                    <div class="col p-1 text-center align-self-center">
                        <span class="badge bg-transparent border-danger border text-danger font-re fw-light">
                            بسته شده
                        </span>
                    </div>
                    <div class="col-1 p-1 text-center align-self-center d-md-block d-none">
                        <i class="bi bi-chevron-left"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="item">
            <a href="#" class="font-re small m-0 d-block">
                <div class="row w-100 m-0">
                    <div class="col-1 p-1 text-center align-self-center">
                        <p class="font-re small m-0">
                            1
                        </p>
                    </div>
                    <div class="col p-1 text-center align-self-center">
                        <p class="font-re small m-0">
                            عنوان تستی شماره یک
                        </p>
                    </div>
                    <div class="col p-1 text-center align-self-center">
                        <span class="badge bg-transparent border-info border text-info font-re fw-light">
                            درحال بررسی
                        </span>
                    </div>
                    <div class="col-1 p-1 text-center align-self-center d-md-block d-none">
                        <i class="bi bi-chevron-left"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="item">
            <a href="#" class="font-re small m-0 d-block">
                <div class="row w-100 m-0">
                    <div class="col-1 p-1 text-center align-self-center">
                        <p class="font-re small m-0">
                            1
                        </p>
                    </div>
                    <div class="col p-1 text-center align-self-center">
                        <p class="font-re small m-0">
                            عنوان تستی شماره یک
                        </p>
                    </div>
                    <div class="col p-1 text-center align-self-center">
                        <span class="badge bg-transparent border-warning border text-warning font-re fw-light">
                            در انتظار پاسخ
                        </span>
                    </div>
                    <div class="col-1 p-1 text-center align-self-center d-md-block d-none">
                        <i class="bi bi-chevron-left"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
