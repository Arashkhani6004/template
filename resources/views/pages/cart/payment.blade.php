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
                    <li class="list-unstyled ">
                        <a href="{{route('basket.shipping')}}" class="d-flex flex-column align-items-center">
                            <i class="bi bi-truck d-flex"></i>
                            <span class="mt-2 font-re">آدرس</span>
                        </a>
                    </li>
                    <li class="list-unstyled active">
                        <a class="d-flex flex-column align-items-center">
                            <i class="bi bi-wallet2 d-flex"></i>
                            <span class="mt-2 font-re">تایید و پرداخت</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="checkout row w-100 m-0">
            @include('pages.cart._partials.payment.item-list')
            @include('pages.cart._partials.payment.price-box')
        </div>
    </div>

</section>
@include('layouts.common.sweetalert')
@stop
@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/cart/checkout.css?v.18')}}">
<script src="{{asset('assets/site/js/sweetalert2.all.min.js')}}"></script>
@endpush
@push('scripts')
<script src="{{asset('assets/site/js/cart/checkout.js')}}"></script>
@endpush
@push('vue')
    @include('pages.cart._partials.payment.vue')
@endpush
