@extends('layouts.main.master')
@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/packages/detail.css?v0.01')}}">
@endpush
@section('robots', @$package->seoIndex = 0 ? 'index,follow' : 'noindex,nofollow')
@section('title_seo',@$package->seoTitle ? $package->seoTitle : $package->title)
@section('description_seo',@$package->seoDescription)
@section('image_seo',@$package->getImage())
@section('content')
@include('pages.package-detail._partials.header-inner')
<section class="packages detail mt-lg-5 mt-3">
    <div class="container">
        <div class="row w-100 m-0">
            <div class="col-xl-3 col-lg-4 col-md-12 ps-0 pe-lg-3 pe-0 sidebar-package ">
                @include('pages.package-detail._partials.sidebar')
            </div>
            <div class="col-xl-9 col-lg-8 col-md-12 pe-0 ps-lg-3 ps-0">
                <div class="package-description">
                    @include('pages.package-detail._partials.description')
                </div>
            </div>
            <div class="d-lg-none d-block">
                @include('pages.package-detail._partials.package-price')
            </div>
        </div>
    </div>
</section>
@stop
