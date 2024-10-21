@extends('CmsCore::_layouts.master')

@section('title') افزودن محصول @stop
@section('content')
<div class="body d-flex py-3">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div
                        class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bolder mb-0">
                            افزودن محصول
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card border p-2">
            <form
                action="{{route('admin.product.create')}}"
                method="POST"
                enctype="multipart/form-data"
                id="cms-form"
                @submit.prevent="validateForm"
            >
                @csrf
                @include('CmsCore::product.product.form')
            </form>
        </div>
    </div>
</div>
@stop
@push('scripts')
    @include('CmsCore::_layouts.blocks.utils.ckeditor-scripts')
    <script src="{{asset('assets/admin/js/vue.js')}}"></script>
    <script src="{{asset('assets/admin/js/validations.js')}}"></script>
@endpush
