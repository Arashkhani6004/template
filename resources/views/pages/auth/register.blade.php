@extends('layouts.main.master')

@section('content')
<section class="hero position-relative">

    <div class="hero-content container">
        <div class="row w-100 m-0">
            <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 p-0 pe-lg-4">
                <h1 class="mb-sm-1 mb-1 fw-bold color-title">
                    ثبت نام
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#" class="d-flex align-items-cente color-title font-re">
                                <i class="bi bi-house d-flex me-1"></i>
                                خانه
                            </a>
                        </li>
                        <li class="breadcrumb-item active color-title" aria-current="page">ثبت نام</li>
                    </ol>
                </nav>

            </div>
        </div>
    </div>
</section>

<section class="login-page mt-lg-0 mt-4">
    <div class="container">
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-8 col-11 p-0 m-auto">
            <div class="login-form">
                <form action="" method="">
                    <div class="icon mb-4">
                        <img src="assets/site/images/incorporation.png" width="75" class="m-auto d-flex">
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label font-small font-re mb-1">نام و نام
                            خانوادگی</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="علی موحدی">
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label font-small font-re mb-1">شماره همراه
                            خود را وارد کنید</label>
                        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="09*********">
                    </div>
                    <button type="submit" class="bt btn-one w-100 py-3 dynamic-color">ورود</button>
                </form>
            </div>
        </div>
    </div>
</section>
@stop

@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/auth/auth.css?v.1')}}">
@endpush