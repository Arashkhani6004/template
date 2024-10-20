@extends('layouts.main.master')
@section('robots', @$seo_data['noindex'] == 0 ? 'index,follow' : 'noindex,nofollow')
@section('title_seo',@$seo_data['title_seo'] ? @$seo_data['title_seo'] : "درباره ما")
@section('description_seo',@$seo_data['description_seo'] ? @$seo_data['description_seo'] : "درباره ما بیشتر بدانید")
@section('content')
@include('pages.about-us._partials.header-inner')
<section class="about-us " id="about_us_branch">
    <div class="px-xxl-5 px-xl-4 px-lg-3">
        <div class="about-inner" style="height: unset !important; ">
            <div class="title-section mb-sm-5 mb-4 m-auto p-0">
                {!! @$settings['about_us'] !!}
            </div>
            @include('layouts.common.branches')
        </div>
    </div>
    @include('layouts.common.slogan-scrollable-animation')
</section>
@stop
@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/us/about-us.css?v0.01')}}">
@endpush
@push('vue')
@include('layouts.main.blocks.main-vue',['element_id'=>'about_us_branch'])
@endpush