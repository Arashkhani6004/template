@extends('layouts.main.master')

@section('content')
<section class="hero position-relative">

    <div class="hero-content container">
        <div class="row w-100 m-0">
            <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 p-0 pe-lg-4">
                <h1 class="mb-sm-1 mb-1 fw-bold color-title">
                    ورود
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('index')}}" class="d-flex align-items-cente color-title font-re">
                                <i class="bi bi-house d-flex me-1"></i>
                                خانه
                            </a>
                        </li>
                        <li class="breadcrumb-item active color-title" aria-current="page">ورود</li>
                    </ol>
                </nav>

            </div>
        </div>
    </div>
</section>

<section class="login-page mt-lg-0 mt-4" id="app">
    <div class="container">
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-8 col-11 p-0 m-auto">
            <div class="login-form">
                <form action="{{route('auth.login',Request::all())}}" method="POST" id="auth-form"
                      @submit.prevent="disableSubmit">
                    @csrf
                    <div class="icon mb-4" v-if="userExists">
                        <img src="{{asset('assets/site/images/people.png')}}" width="75" class="m-auto d-flex">
                    </div>
                    <div class="icon mb-4" v-if="!userExists">
                        <img src="{{asset('assets/site/images/incorporation.png')}}" width="75" class="m-auto d-flex">
                    </div>
                    <div class="mb-2" v-if="!userExists">
                        <label for="exampleFormControlInput1" class="form-label font-small font-re mb-1">نام و نام
                            خانوادگی</label>
                        <input  required oninvalid="warnRequired(' نام ونام خانوادگی')" name="name"
                                type="text" class="form-control" id="exampleFormControlInput1" placeholder="علی موحدی">
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label font-small font-re text-center w-100">شماره همراه خود را وارد
                            کنید</label>
                        <input v-model="mobile" name="mobile" type="text" class="form-control text-center" id="exampleFormControlInput1" placeholder="09*********"
                               required oninvalid="warnRequired(' شماره همراه')"
                               onchange="checkMobile(event)">
                    </div>
                    <button v-if="userExists" type="button" @click="checkUserExists" class="bt btn-one w-100 py-3 dynamic-color">
                        ورود
                        <div v-if="loading" class="spinner-border" role="status" style="width: 15px;height: 15px;"></div>
                    </button>
                    <button v-else type="submit" class="bt btn-one w-100 py-3 dynamic-color" id="submit-register">
                  ثبت نام
                        <div v-if="loading" class="spinner-border" role="status" style="width: 15px;height: 15px;"></div>
                    </button>
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
    <script src="{{asset('assets/site/js/validate.js')}}"></script>
@endpush
@push('vue')
    @include('pages.auth._partials.vue')
@endpush
