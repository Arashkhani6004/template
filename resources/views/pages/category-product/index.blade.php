@extends('layouts.main.master')
@section('robots', @$seo_data['noindex'] == 0 ? 'index,follow' : 'noindex,nofollow')
@section('title_seo',@$seo_data['title_seo'] ? @$seo_data['title_seo'] : "دسته")
@section('description_seo',@$seo_data['description_seo'] ? @$seo_data['description_seo'] : "لیست دسته")
@section('content')
    <section class="hero position-relative">
        <div class="hero-content container">
            <div class="row w-100 m-0">
                <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 p-0 pe-lg-4">
                    <h1 class="mb-sm-1 mb-1 fw-bold color-title">
                        دسته بندی محصولات
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('index')}}" class="d-flex align-items-cente color-title font-re">
                                    <i class="bi bi-house d-flex me-1"></i>
                                    خانه
                                </a>
                            </li>
                            <li class="breadcrumb-item active color-title" aria-current="page">دسته بندی محصولات</li>
                        </ol>
                    </nav>

                </div>
            </div>
        </div>
    </section>
    <section class="pro-cat mt-3">
        <div class="container">
            <div class="row w-100 m-0">
                @foreach($product_categories as $product_category)
                    <div
                        class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-6 p-xxl-3 p-xl-2 p-lg-2 p-sm-2 p-1 mb-sm-0 mb-4">
                        <div class="cat-card">
                            <a href="{{ route('category.detail', ['url' => $product_category['url']]) }}"
                               class="h-rotate color-title">
                                <p class="font-md mb-2 dynamic-color name">
                                    {{@$product_category['title']}}
                                </p>
                                {{--                        <p class="font-num-r mb-3">--}}
                                {{--                            ۳۲ محصول--}}
                                {{--                        </p>--}}
                                <div class="img-cat">
                                    <img src="{{@$product_category->getImage('big')}}" alt="{{@$product_category['title']}}"
                                         title="{{@$product_category['title']}}" loading="lazy">
                                </div>
                                <span class="arrow-box m-0">
                                <i class="bi bi-arrow-up-left d-flex main-icon dynamic-color fs-5"></i>
                        </span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- seo box -->
    <section class="seo-box">
        <div class="container">
            <div class="box">
                <div class="boxdes">
                    <input type="checkbox" id="expanded">
                    <div id="text-box" class="p text-start">
                        {!!   @$settings['category_description'] !!}
                    </div>
                    <label for="expanded" id="more-button" role="button" class="btn button btn-one m-auto px-4 py-2">
                        بیشتر
                    </label>
                </div>
            </div>
        </div>
    </section>
@stop
@push('styles')
    <link rel="stylesheet" href="{{asset('assets/site/css/product/category.css?v0.02')}}">
@endpush
