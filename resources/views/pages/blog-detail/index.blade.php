@extends('layouts.main.master')
@section('robots', @$blog->seoIndex == 0 ? 'index,follow' : 'noindex,nofollow')
@section('title_seo',@$blog->seoTitle ? $blog->seoTitle : $blog->title)
@section('description_seo',@$blog->seoDescription)
@section('image_seo',@$blog->item_image)
@section('content')
@include('pages.blog-detail._partials.header-inner')
<div class="content">
    <div class="container">
        <div class="row w-100 m-0">
            <div class="col-xl-3 col-lg-4 col-md-12 p-lg-2 p-1 sidebar d-lg-block d-none">
                <div class="position-sticky">
                    @include('pages.blog-detail._partials.main-img')
                    @include('pages.blog-detail._partials.related-service')
                    @include('pages.blog-detail._partials.related-blog')
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-12 p-1">
                <!-- description -->
                <section class="service-description">
                    @include('pages.blog-detail._partials.description')
                </section>
                <!-- related service mobile -->
                <div class="d-lg-none d-block">
                    @include('pages.blog-detail._partials.related-service')
                </div>
                <!-- related blogs mobile -->
                <div class="d-lg-none d-block">
                    @include('pages.blog-detail._partials.related-blog')
                </div>

            </div>
        </div>
    </div>
</div>

<!-- comments -->

@include('layouts.common.comment.comments',['commentable_id'=>$blog['id'],'commentable_type'=>get_class($blog)])
@stop
@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/blogs/blog.css?v0.01')}}">
@endpush
