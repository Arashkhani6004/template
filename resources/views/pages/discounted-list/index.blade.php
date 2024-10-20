@extends('layouts.main.master')
@section('robots', @$seo_data['noindex'] == 0 ? 'index,follow' : 'noindex,nofollow')
@section('title_seo',@$seo_data['title_seo'] ? @$seo_data['title_seo'] : " محصولات شگفت انگیز")
@section('description_seo',@$seo_data['description_seo'] ? @$seo_data['description_seo'] : " محصولات شگفت انگیز")
@section('content')
    <section class="hero position-relative">
        <div class="hero-content container">
            <div class="row w-100 m-0">
                <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 p-0 pe-lg-4">
                    <h1 class="mb-sm-1 mb-1 fw-bold color-title">
                        محصولات شگفت انگیز
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="{{route('index')}}" class="d-flex align-items-cente color-title font-re">
                                    <i class="bi bi-house d-flex me-1"></i>
                                    خانه
                                </a>
                            </li>
                            <li class="breadcrumb-item active color-title" aria-current="page"> محصولات شگفت انگیز</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="list-product">
        <div class="container">
            <div class="row w-100 m-0">
                @foreach($timer_products as $timer)
                    <div class="col-xxl-2 col-xl-3 col-md-4 col-6 p-1">
                        <div class="offer-card">
                            <a href="{{ route('product.detail', ['url' => $timer['url']]) }}" class="color-title">
                                <div class="product-card">
                                    @if($timer->percent)(
                                        <div class="off font-num-r">
                                            {{$timer->percent}}%
                                        </div>
                                    @endif
                                    <img src="{{$timer->getImage('medium')}}" class="w-100" alt="{{$timer['title']}}"
                                         title="{{$timer['title']}}" loading="lazy">
                                    <div class="name mt-2">
                                        <p class="font-bold m-0">{{$timer['title']}}</p>
                                    </div>
                                    <div class="price mt-2">
                                        @if($timer['final_price'] != 0)
                                            <p class="m-0 font-num-r fw-bolder">{{number_format($timer['final_price'])}} تومان</p>
                                        @endif
                                        @if($timer['price'])
                                            <div class="old-price">
                                                <p class="m-0 font-num-r">{{number_format($timer['price'])}} تومان </p>
                                            </div>
                                        @endif
                                    </div>
                                    <ul class="p-0 m-0 d-flex align-items-center countdown justify-content-center gap-2 mt-2">
                                        <li><span id="seconds{{$timer['id']}}"></span></li>
                                        :
                                        <li><span id="minutes{{$timer['id']}}"></span></li>
                                        :
                                        <li><span id="hours{{$timer['id']}}"></span></li>
                                        <li><span id="days{{$timer['id']}}" class="me-1"></span>روز</li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @component("layouts.common.pagination.default")
            @slot("paginator",$products)
        @endcomponent
    </section>
    @include('pages.first-page._partials.timer-script')
@stop
@push('styles')
    <link rel="stylesheet" href="{{asset('assets/site/css/product/list.css?v0.05')}}">
@endpush
