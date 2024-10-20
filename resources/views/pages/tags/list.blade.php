@extends('layouts.main.master')
@section('robots', @$seo_data['noindex'] == 0 ? 'index,follow' : 'noindex,nofollow')
@section('title_seo',@$seo_data['title_seo'] ? @$seo_data['title_seo'] : "تگ ها ")
@section('description_seo',@$seo_data['description_seo'] ? @$seo_data['description_seo'] : "لیست تگ ها")
@section('content')
    <section class="hero position-relative">
        <div class="hero-content container">
            <div class="row w-100 m-0">
                <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 p-0 pe-lg-4">
                    <h1 class="mb-sm-1 mb-1 fw-bold color-title">
                        تگ ها
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="{{route('index')}}" class="d-flex align-items-cente color-title font-re">
                                    <i class="bi bi-house d-flex me-1"></i>
                                    خانه
                                </a>
                            </li>
                            <li class="breadcrumb-item active color-title" aria-current="page"> تگ ها</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="list-product tags">
        <div class="container">
            <ul class="d-flex align-items-center gap-3 flex-wrap p-0 m-0 mt-5">
                @foreach($tags as $tag)
                    <li class="list-unstyled mb-3">
                        <a href="{{ route('tag.detail', ['url' => $tag['url']]) }}" class="tag-item font-re">
                            {{$tag['title']}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@stop
@push('styles')
    <link rel="stylesheet" href="{{asset('assets/site/css/product/list.css?v0.04')}}">
@endpush
