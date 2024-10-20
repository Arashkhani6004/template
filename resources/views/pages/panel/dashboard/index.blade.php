@extends('pages.panel.master')
@section('dashboard','active')
@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/panel/panel.css?v.1')}}">
@endpush
@section('content')
<div class="header p-3">
    <p class="font-md m-0 d-flex align-items-center h3">
        <i class="bi bi-speedometer2 me-2 d-flex"></i>
        داشبورد
    </p>
</div>
<div class="content px-xl-3 py-2">
    <div class="row w-100 m-0">
        @include('pages.panel.dashboard._partials.personal-info')
{{--        <div class="col-xl-12 p-1 mt-3">--}}
{{--        @include('pages.panel.dashboard._partials.favorites')--}}
{{--        </div>--}}
    </div>
</div>
@endsection
