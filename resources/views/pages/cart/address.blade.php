@extends('layouts.main.master')
@section('content')
<section class="hero position-relative">

</section>

<section class="cart mx-md-4 mt-3">
    <div class="container" id="app" v-cloak>
        <div class="col-xl-12 p-0">
            <div class="steps">
                <ul class="p-0 m-0 d-flex align-items-center ">
                    <li class="list-unstyled ">
                        <a href="{{route('basket.cart')}}" class="d-flex flex-column align-items-center">
                            <i class="bi bi-cart d-flex"></i>
                            <span class="mt-2 font-re">سبد خرید</span>
                        </a>
                    </li>
                    <li class="list-unstyled active">
                        <a class="d-flex flex-column align-items-center">
                            <i class="bi bi-truck d-flex"></i>
                            <span class="mt-2 font-re">آدرس</span>
                        </a>
                    </li>
                    <li class="list-unstyled">
                        <a class="d-flex flex-column align-items-center">
                            <i class="bi bi-wallet2 d-flex"></i>
                            <span class="mt-2 font-re">تایید و پرداخت</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="checkout row w-100 m-0">
            <div class="col-xl-9 col-lg-8 ps-0 pe-0 pe-lg-2 mt-4">
                <div class="addresses bg-white shadow-sm p-3 rounded-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="font-bold m-0">آدرس های من</p>
                        <button type="button" class="btn color-theme-one p-0 d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="bi bi-plus d-flex"></i>
                            افزودن آدرس جدید
                        </button>
                    </div>

                    <hr class="my-2">
                    <div class="row w-100 m-0" v-if="loadingList == true">
                        <div class="col-xl-6 m-auto text-center">
                            @include("layouts.common.loading")
                        </div>
                    </div>
                    <div class="row w-100 m-0 p-0" v-else>
                    <div class="row w-100 m-0 p-0" v-if="locations.length != 0" >
                       @include('pages.cart._partials.address.address-list')
                    </div>
                    <div class="row w-100 m-0 p-0" v-else>
                        <div class="col-xxl-2 col-xl-3 col-lg-5 col-md-6 col-6 p-0 m-auto">
                            <img src="{{asset('assets/site/images/emptyadress.png')}}" class="w-100" alt="empty-adress"/>
                        </div>
                        <p class="m-0 mb-2 text-center">آدرسی برای شما ثبت نشده است...!</p>
                        <p class="m-0 text-center">لطفا آدرس خود را اضافه کنید</p>
                    </div>
                    </div>

                    @include('pages.cart._partials.address.add-modal')
                    @include('pages.cart._partials.address.shipping')

                </div>
            </div>
            <div class="col-xl-3 col-lg-4 pe-0 ps-0 ps-lg-2 mt-4">
                @include('pages.cart._partials.address.price-box')
            </div>
        </div>
        <div class="mobile-checkout-btn d-lg-none d-block">
            <ul class="p-0 m-0 d-flex align-items-center justify-content-between">
                <li class=" list-unstyled">
                    <a href="{{route('basket.payment')}}" class="btn btn-one-outline dynamic-color py-2 w-100 btn-sm">
                        تایید و تکمیل سفارش
                    </a>
                </li>
                <li class=" list-unstyled">
                    <p class="font-num-r m-0 fw-bold">
                        @{{ priceCart }}
                    </p>
                </li>
            </ul>
        </div>
    </div>

</section>
@stop
@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/cart/checkout.css?v.15')}}">
<script src="{{asset('assets/site/js/sweetalert2.all.min.js')}}"></script>
@endpush
@push('scripts')
<script src="{{asset('assets/site/js/cart/checkout.js')}}"></script>
@endpush
@push('vue')
    @include('pages.cart._partials.address.vue')
@endpush
