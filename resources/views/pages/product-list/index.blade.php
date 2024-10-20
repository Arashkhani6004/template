@extends('layouts.main.master')
@section('robots', @$product_category->seoIndex == 0 ? 'index,follow' : 'noindex,nofollow')
@section('title_seo',@$product_category->seoTitle ? $product_category->seoTitle : $product_category->title,)
@section('description_seo',@$product_category->seoDescription)
@section('image_seo',@$product_category->getImage())
@section('content')
    <section class="hero position-relative">
        <div class="hero-content container">
            <div class="row w-100 m-0">
                <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 p-0 pe-lg-4">
                    <h1 class="mb-sm-1 mb-1 fw-bold color-title">
                        {{$product_category['title']}}
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="{{route('index')}}" class="d-flex align-items-cente color-title font-re">
                                    <i class="bi bi-house d-flex me-1"></i>
                                    خانه
                                </a>
                            </li>
                            <li class="breadcrumb-item active color-title"
                                aria-current="page"> {{$product_category['title']}} </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="list-product">
        <div class="container">
            @include('pages.product-list._partials.upper-categories')
            @include('pages.product-list._partials.price-desktop-script')
            @include('pages.product-list._partials.price-mobile-script')
            <div class="row w-100 m-0" id="app" v-cloak>

                @include('pages.product-list._partials.desktop-filter')
                @include('pages.product-list._partials.mobile-filter')

                <!-- list -->
                <div class="col-xl-9 col-lg-8 p-lg-2 p-1">
                    @include('pages.product-list._partials.sort')

                    <div class="row w-100 m-0 lists p-1" v-scroll="scroll">
                        @include('pages.product-list._partials.laravel-list')
                        @include('pages.product-list._partials.vue-list')
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
    @include('pages.product-list._partials.description')
@stop
@push('styles')
    <link rel="stylesheet" href="{{asset('assets/site/css/product/list.css?v0.1')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/product/jquery-ui.css')}}">
    <script src="{{asset('assets/site/js/shared/jquery.min.js')}}"></script>
    <script src="{{asset('assets/site/js/product/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/site/js/product/jquery.ui.touch-punch.min.js')}}"></script>
@endpush
@push('vue')
    @include('pages.product-list._partials.vue')
@endpush
