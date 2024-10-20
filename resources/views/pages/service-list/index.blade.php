@extends('layouts.main.master')
@push('styles')
    <link rel="stylesheet" href="{{asset('assets/site/css/services/list.css?v0.01')}}">
@endpush
@if(isset($service))
    @section('robots', @$service->seoIndex == 0 ? 'index,follow' : 'noindex,nofollow')
    @section('title_seo',@$service->seoTitle ? $service->seoTitle : $service->title)
    @section('description_seo',@$service->seoDescription)
    @section('image_seo',@$service->image)
@else
    @section('robots', @$seo_data['noindex'] == 0 ? 'index,follow' : 'noindex,nofollow')
    @section('title_seo',@$seo_data['title_seo'] ? @$seo_data['title_seo'] : "خدمات")
    @section('description_seo',@$seo_data['description_seo'] ? @$seo_data['description_seo'] : "لیست خدمات")
@endif
@section('content')
    @if(isset($service))
        @include('pages.service-list._partials.header-inner-with-children')
    @else
        @include('pages.service-list._partials.header-inner')
    @endif
    @include('layouts.common.banner-scrollable-animation')
    <section class="list-services mt-5">
        <div class="container">
         @include('pages.service-list._partials.list')
        </div>
    </section>
    @if(isset($settings['service_description']) || isset($service['description']))
    @include('pages.service-list._partials.description')
    @endif
@stop
