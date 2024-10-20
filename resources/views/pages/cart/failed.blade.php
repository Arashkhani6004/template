@extends('layouts.main.master')
@section('content')
<section class="hero position-relative">

</section>
<div class="refrence">
    <div class=" container">
        <div class="col-xxl-3 col-xl-4 col-lg-5 col-md-6 col-8 m-auto d-flex justify-content-center align-items-center flex-column">
            <img src="{{asset('assets/site/images/Frame 24.png')}}" class="w-100">
            <div class="d-flex align-items-center">
                <a href="{{route('basket.cart')}}" class="btn btn-one btn-sm dynamic-color px-4">
                    بازگشت به سبد خرید
                </a>
            </div>
        </div>
    </div>
</div>

@stop
@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/cart/checkout.css?v.1')}}">
@endpush
