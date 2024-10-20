@extends('layouts.main.master')
@section('robots', @$seo_data['noindex'] == 0 ? 'index,follow' : 'noindex,nofollow')
@section('title_seo',@$seo_data['title_seo'] ? @$seo_data['title_seo'] : "تماس با ما")
@section('description_seo',@$seo_data['description_seo'] ? @$seo_data['description_seo'] : "با ما در تماس باشید")
@section('content')
@include('pages.contact-us._partials.header-inner')
<section class="conatct-us my-5">
    <div class="container">
        <div class="row w-100 m-0">
            <div class="col-lg-6 p-0 pe-lg-3 pe-0 ps-0 align-self-center mb-lg-0 mb-4">
                @include('pages.contact-us._partials.contact-info')
            </div>
            <div class="col-lg-6 p-0 ps-lg-3 ps-0 pe-0 align-self-center">
                @include('pages.contact-us._partials.contact-form')
            </div>
        </div>
    </div>
</section>
@stop
@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/us/contact-us.css')}}">
<script src="{{asset('assets/site/js/sweetalert2.all.min.js')}}"></script>
@endpush
