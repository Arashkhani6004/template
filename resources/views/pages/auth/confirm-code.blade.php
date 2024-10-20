@extends('layouts.main.master')

@section('content')
<section class="hero position-relative">

    <div class="hero-content container">
        <div class="row w-100 m-0">
            <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 p-0 pe-lg-4">
                <h1 class="mb-sm-1 mb-1 fw-bold color-title">
                    کد تایید
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('index')}}" class="d-flex align-items-cente color-title font-re">
                                <i class="bi bi-house d-flex me-1"></i>
                                خانه
                            </a>
                        </li>
                        <li class="breadcrumb-item active color-title" aria-current="page">کد تایید</li>
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
                <form action="{{route('auth.confirm-code',Request::all())}}" method="POST">
                    @csrf
                    <input type="hidden" name="mobile" value="{{\request()->get('mobile')}}">
                    <div class="icon mb-4">
                        <img src="{{asset('assets/site/images/mail.png')}}" width="75" class="m-auto d-flex">
                    </div>

                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label font-small font-num-r text-center w-100">کد تایید به شماره<span class="mx-1">{{\request()->get('mobile')}}</span>پیامک شد.
                            <a href="{{route('auth.index')}}" class="link font-small font-th text-deco">ویرایش شماره</a></label>
                        <input name="code" type="text" class="form-control text-center" id="exampleFormControlInput1" placeholder="کد تایید پیامک  شده را وارد کنید">
                    </div>
                    <button type="submit" class="bt btn-one w-100 py-3 dynamic-color">ورود</button>
                </form>
                    <p id="el" class="small font-re text-center my-2 d-flex align-items-center justify-content-center">پس از
                        گذشت <span id="timer" class="font-num-r">02:00</span> دقیقه مجدد تلاش کنید</p>
                    <form action="{{route('auth.login',Request::all())}}" method="POST" id="auth-form"
                        >
                        @csrf
                        <input type="hidden" name="mobile" value="{{\request()->get('mobile')}}">
                    <button type="submit" id="againCode" class="btn btn-again mt-2">ارسال مجدد کد</button>
                    </form>
            </div>
        </div>
    </div>
</section>
@stop

@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/auth/auth.css?v.1')}}">
<script src="{{asset('assets/site/js/sweetalert2.all.min.js')}}"></script>
@endpush
@push('scripts')
<script src="{{asset('assets/site/js/auth/auth.js?v0.01')}}"></script>
@endpush
