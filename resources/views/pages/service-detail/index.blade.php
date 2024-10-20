@extends('layouts.main.master')
@section('robots', @$service->seoIndex == 0 ? 'index,follow' : 'noindex,nofollow')
@section('title_seo',@$service->seoTitle ? $service->seoTitle : $service->title)
@section('description_seo',@$service->seoDescription)
@section('image_seo',@$service->image)
@section('content')
    @include('pages.service-detail._partials.header-detail')
    @include('pages.service-detail._partials.samples-inner')
    @include('pages.service-detail._partials.price-table')
    @include('pages.service-detail._partials.seo-box')
    @include('pages.service-detail._partials.related-service')
    @include('pages.service-detail._partials.related-blogs')
    @include('layouts.common.comment.comments',['commentable_id'=>$service['id'],'commentable_type'=>get_class($service)])
@stop
@push('styles')
    <link rel="stylesheet" href="{{asset('assets/site/css/services/service.css?v0.1')}}">
@endpush
@push('scripts')
    <script src="{{asset('assets/site/js/services/service.js?v0.01')}}"></script>
@endpush
