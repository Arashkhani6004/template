@extends('layouts.main.master')
@section('robots', @$blog_category->seoIndex == 0 ? 'index,follow' : 'noindex,nofollow')
@section('title_seo',@$blog_category->seoTitle ? $blog_category->seoTitle : $blog_category->title)
@section('description_seo',@$blog_category->seoDescription)
@section('image_seo',@$blog_category['header_image'])
@section('content')
@include('pages.blog-list._partials.header-inner')
<section class="list-services mt-5">
    <div class="container">
        <div class="row w-100 m-0">
            @foreach($blogs as $blog)
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 p-xxl-2 p-xl-1 p-lg-2 p-sm-2 p-1 mb-sm-0 mb-4">
                <div class="package-card">
                    <a href="{{ route('blog.detail', ['url' => $blog['url']]) }}"
                        class="color-title text-start h-rotate">
                        <img src="{{$blog->item_image}}" class="w-100 main-image" alt="{{$blog['title']}}"
                            title="{{$blog['title']}}">
                        <div class="py-4 px-3">
                            <div class="row w-100 m-0 mb-3">
                                <div class="col-lg-9 col-10 pe-1 p-0 align-self-center">
                                    <div class="package-title">
                                        <p class="m-0 font-bold">
                                            {{$blog['title']}}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-2 ps-1 p-0 align-self-center">
                                    <span class="arrow ms-auto">
                                        <img src="{{asset('assets/site/images/left-top-arrow.svg')}}" class="main-icon"
                                            alt="package-icon" title="package-icon">
                                    </span>
                                </div>
                            </div>
                            <div class="short-des mb-3">
                                <p class="font-re small m-0">
                                    {!! strip_tags(\Illuminate\Support\Str::limit($blog['description'],170)) !!}
                                </p>
                            </div>
                            <ul class="p-0 m-0 d-flex align-items-center justify-content-between pt-3 flex-wrap mb-2">
                                <li class="d-flex align-items-center font-re font-small text-secondary m-1">
                                    <i class="bi bi-calendar4 color-theme-two fs-5 d-flex me-1"></i>
                                    {{jdate('l j F Y',strtotime($blog['publish_date']))}}
                                </li>
                                <li class="d-flex align-items-center font-re font-num-r font-small text-secondary m-1">
                                    <i class="bi bi-eye color-theme-two fs-5 d-flex me-1"></i>
                                    {{$blog['view']}}
                                </li>
                            </ul>
                            {{--                            //Todo ui: عدد فارسی--}}
                            <p class="font-small font-num-r font-re d-flex align-items-center m-1 text-secondary">
                                <i class="bi bi-clock d-flex me-1 color-theme-two fs-5"></i>
                                خواندن این مطلب {{$blog['reading_time']}} دقیقه زمان خواهد برد
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@stop
@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/blogs/list.css?v0.01')}}">
@endpush
