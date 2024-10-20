@extends('layouts.main.master')
@section('robots', @$tag->seoIndex == 0 ? 'index,follow' : 'noindex,nofollow')
@section('title_seo',@$tag->seoTitle ? $item->seoTitle : $item->title)
@section('description_seo',@$tag->seoDescription)
@section('image_seo',@$tag->item_image)
@push('styles')
    <link rel="stylesheet" href="{{asset('assets/site/css/search/search.css?v0.03')}}">
@endpush
@section('content')
    <section class="hero position-relative">
        <div class="hero-content container">
            <div class="row w-100 m-0">
                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-0 m-auto text-center">
                    <h1 class="mb-sm-2 mb-1 font-bold color-title">
                        {{$tag['title']}}
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 justify-content-center">
                            <li class="breadcrumb-item">
                                <a href="{{route('index')}}" class="d-flex align-items-center color-title font-th">
                                    <i class="bi bi-house d-flex me-1"></i>
                                    خانه
                                </a>
                            </li>
                            <li class="breadcrumb-item active color-title font-th"
                                aria-current="page"> {{$tag['title']}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="search-page">
        <div class="container">
        </div>
        <div class="tabs-buttons mt-3 position-sticky top-0">
            <div class="container">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    {{--<li class="nav-item" role="presentation">
                        <button class="nav-link active" id="category-tab" data-bs-toggle="pill" data-bs-target="#category" type="button" role="tab" aria-controls="category" aria-selected="true">دسته بندی محصولات</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="brands-tab" data-bs-toggle="pill" data-bs-target="#brands" type="button" role="tab" aria-controls="brands" aria-selected="false">برند</button>
                    </li>--}}
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="products-tab" data-bs-toggle="pill"
                                data-bs-target="#products" type="button" role="tab" aria-controls="products"
                                aria-selected="false">محصولات
                        </button>
                    </li>
                    {{--<li class="nav-item" role="presentation">
                        <button class="nav-link" id="services-tab" data-bs-toggle="pill" data-bs-target="#services" type="button" role="tab" aria-controls="services" aria-selected="false">خدمات</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="samples-tab" data-bs-toggle="pill" data-bs-target="#samples" type="button" role="tab" aria-controls="samples" aria-selected="false">نمونه کار</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="blogs-tab" data-bs-toggle="pill" data-bs-target="#blogs" type="button" role="tab" aria-controls="blogs" aria-selected="false">مطالب</button>
                    </li>--}}
                </ul>
            </div>
        </div>
        <div class="container mt-3">
            <div class="result pb-5">
                <div class="tab-content" id="pills-tabContent">
                    {{--<div class="tab-pane fade show active" id="category" role="tabpanel" aria-labelledby="category-tab" tabindex="0">
                        @include('pages.tags._partials.categories')
                    </div>
                    <div class="tab-pane fade" id="brands" role="tabpanel" aria-labelledby="brands-tab" tabindex="0">
                        @include('pages.tags._partials.brands')
                    </div>--}}
                    <div class="tab-pane fade show active" id="products " role="tabpanel" aria-labelledby="products-tab"
                         tabindex="0">
                        @include('pages.tags._partials.products')
                    </div>
                    {{--<div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="services-tab" tabindex="0">
                        @include('pages.tags._partials.services')
                    </div>
                    <div class="tab-pane fade" id="samples" role="tabpanel" aria-labelledby="samples-tab" tabindex="0">
                        @include('pages.tags._partials.samples')
                    </div>
                    <div class="tab-pane fade" id="blogs" role="tabpanel" aria-labelledby="blogs-tab" tabindex="0">
                        @include('pages.tags._partials.blogs')
                    </div>--}}
                </div>
            </div>
        </div>
    </section>
@stop
@push('scripts')
    <script src="{{asset('assets/site/js/search/search.js?v0.01')}}"></script>
@endpush
