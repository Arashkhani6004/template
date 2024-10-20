@extends('layouts.main.master')
@section('robots', @$seo_data['noindex'] == 0 ? 'index,follow' : 'noindex,nofollow')
@section('title_seo',@$seo_data['title_seo'] ? @$seo_data['title_seo'] : "برند ما")
@section('description_seo',@$seo_data['description_seo'] ? @$seo_data['description_seo'] : "برندهای ما")
@section('content')
    <section class="hero position-relative">
        <div class="hero-content container">
            <div class="row w-100 m-0">
                <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 p-0 pe-lg-4">
                    <h1 class="mb-sm-1 mb-1 fw-bold color-title">
                        برندها
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="{{route('index')}}" class="d-flex align-items-cente color-title font-re">
                                    <i class="bi bi-house d-flex me-1"></i>
                                    خانه
                                </a>
                            </li>
                            <li class="breadcrumb-item active color-title" aria-current="page">برند ها</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="list-brands mx-md-0 mt-3">
        <div class="container">
            <div class="col-xl-4 col-lg-6 col-md-8 col-12 p-0 m-auto mb-4">
                <div class="form position-relative">
                    <form method="get" action="{{url()->current()}}">
                        <input type="search" class="form-control rounded-4" name="title" value="{{request()->get('title')}}" placeholder="جستجوی نام برند">
                        <button type="submit"
                            class="btn bg-transparent border-0 shadow-none p-2 position-absolute top-0 bottom-0 end-0">
                            <i class="bi bi-search d-flex fs-5"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="row w-100 m-0">
                @foreach($brands as $brand)
                    <div class="col-xl-3 col-md-4 col-6 text-center p-2">
                        <a href="{{route('brand.detail',['url'=>$brand['url']])}}">
                            <div class="card brand-card p-2">
                                <img src="{{ $brand->item_image }}" title="{{$brand['title']}}" alt="{{$brand['title']}}" class="w-100">
                                <p class="mt-2 mb-1">
                                    {{$brand['title']}}
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@stop
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/site/css/brand/list.css?v0.2') }}">
@endpush
