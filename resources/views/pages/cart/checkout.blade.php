@extends('layouts.main.master')
@section('content')
<section class="hero position-relative">

</section>

<section class="cart mx-md-4 mt-3">
    <div class="container" id="app" v-cloak>
        <div v-if="itemListLoading == true">
            <div class="col-xl-6 m-auto text-center">
                @include("layouts.common.loading")
            </div>
        </div>
        <div v-else>
            <div v-if="items.length != 0">
                <div class="col-xl-12 p-0">
                    <div class="steps">
                        <ul class="p-0 m-0 d-flex align-items-center ">
                            <li class="list-unstyled active">
                                <a class="d-flex flex-column align-items-center">
                                    <i class="bi bi-cart d-flex"></i>
                                    <span class="mt-2 font-re">سبد خرید</span>
                                </a>
                            </li>
                            <li class="list-unstyled">
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
                        <div class="products">
                            <div class="d-flex align-items-center justify-content-end mb-1">
                                <p class="text-end m-0 font-num-r small text-black-50">
                                    (@{{ totalQuantity }} کالا)
                                </p>
                                <a href="{{route('basket.cart-delete')}}" type="button" class="btn btn-one-outline py-1 px-3 btn-sm dynamic-color ms-2">پاک کردن سبد خرید</a>

                            </div>

                            <div class="product-item shadow-sm bg-white rounded-4 overflow-hidden position-relative mb-3"
                                v-for="(item, index) in items" :key="item.id">
                                @include('pages.cart._partials.checkout.item-list')

                            </div>

                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 pe-0 ps-0 ps-lg-2 mt-4" >
                        @include('pages.cart._partials.checkout.price-box')

                    </div>
                </div>
                <div class="mobile-checkout-btn d-lg-none d-block">
                    <ul class="p-0 m-0 d-flex align-items-center justify-content-between">
                        <li class=" list-unstyled">
                            <a href="{{route('basket.shipping')}}" class="btn btn-one-outline dynamic-color py-2 w-100 btn-sm">
                                تایید و تکمیل سفارش
                            </a>
                        </li>
                        <li class=" list-unstyled">
                            <p class="font-num-r m-0 fw-bold">
                                @{{ finalPriceSum }}
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
            <div v-else>
                <div class="bg-white rounded-4 pb-4">
                    <div class="col-xxl-3 col-xl-4 col-lg-5 col-md-6 col-8 m-auto text-center ">
                        <img src="{{asset('assets/site/images/empytcart5.png')}}" class="w-100" alt="empty-icon" title="empty-icon" />

                    </div>
                    <p class=" font-bold text-center h4 mb-0">سبد خرید شما خالی است...!</p>
                </div>
            </div>
        </div>


    </div>

</section>
@stop
@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/cart/checkout.css?v.17')}}">
<script src="{{asset('assets/site/js/sweetalert2.all.min.js')}}"></script>
@endpush
@push('scripts')
<script src="{{asset('assets/site/js/cart/checkout.js')}}"></script>
@endpush
@push('vue')
@include('pages.cart._partials.checkout.vue')
@endpush
