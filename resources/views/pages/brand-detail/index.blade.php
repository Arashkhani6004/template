@extends('layouts.main.master')
@section('robots', @$brand->seoIndex == 0 ? 'index,follow' : 'noindex,nofollow')
@section('title_seo',@$brand->seoTitle ? $brand->seoTitle : $brand->title)
@section('description_seo',@$brand->seoDescription)
@section('image_seo',@$brand->item_image)
@section('content')
    <section class="hero position-relative brand-detail">
        <div class="hero-content container">
            <div class="row w-100 m-0">
                <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-11 col-sm-10 col-9 p-0 pe-lg-4 align-self-center">
                    <h1 class="mb-sm-1 mb-1 fw-bold color-title">
                        {{$brand['title']}}
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="{{route('index')}}" class="d-flex align-items-cente color-title font-re">
                                    <i class="bi bi-house d-flex me-1"></i>
                                    خانه
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('brand.list')}}" class="d-flex align-items-cente color-title font-re">
                                    برند ها
                                </a>
                            </li>
                            <li class="breadcrumb-item active color-title" aria-current="page">{{$brand['title']}}</li>
                        </ol>
                    </nav>

                </div>
                <div class="col-md-1 col-sm-2 col-3 p-1 d-lg-none d-block">
                    <img src="{{$brand['image']}}" class="w-100 rounded-4" width="100%" alt="{{$brand['title']}}"
                         title="{{$brand['title']}}" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <section class="list-product">
        <div class="container">
            @include('pages.brand-detail._partials.price-desktop-script')
            @include('pages.brand-detail._partials.price-mobile-script')
            <div class="row w-100 m-0" id="app" v-cloak>
                @include('pages.brand-detail._partials.filter-desktop')
                @include('pages.brand-detail._partials.filter-mobile')
                <!-- list -->
                <div class="col-xl-9 col-lg-8 p-lg-2 p-1">
                    @include('pages.brand-detail._partials.sort')
                    <div class="row w-100 m-0 lists p-2" v-scroll="scroll">
                        @include('pages.brand-detail._partials.laravel-list')
                        @include('pages.brand-detail._partials.vue-list')
                        <div id="scrollMePlease"></div>

                    </div>
                    <div v-if="scrollable == false">
                        <paginate
                            :initial-page="page - 1"
                            v-model="page"
                            v-if="products.length != 0 && !loading"
                            :page-count="pageCount"
                            :click-handler="handlePageClick"
                            :prev-text="'قبلی'"
                            :next-text="'بعدی'"
                            :container-class="'custom-paginate'"
                        >
                        </paginate>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('pages.brand-detail._partials.description')
@stop
@push('styles')
    <link rel="stylesheet" href="{{asset('assets/site/css/product/list.css?v0.04')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/product/jquery-ui.css')}}">
    <script src="{{asset('assets/site/js/shared/jquery.min.js')}}"></script>
    <script src="{{asset('assets/site/js/product/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/site/js/product/jquery.ui.touch-punch.min.js')}}"></script>
    <script src="{{asset('assets/site/js/product/filter.js')}}"></script>
@endpush
@push('scripts')
    <script src="{{asset('assets/site/js/product/list.js')}}"></script>
@endpush
@push('vue')
    @include('pages.brand-detail._partials.vue')
@endpush
