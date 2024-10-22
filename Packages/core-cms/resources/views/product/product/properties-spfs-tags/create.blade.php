@extends('CmsCore::_layouts.master')
@section('title') مشخصات/فیلتر/ویژگی های {{$product->title}}@stop
@section('content')
<div class="body d-flex py-3">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div
                        class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bolder mb-0">
                            مشخصات/فیلتر/ویژگی های {{$product->title}}
                        </h3>
                        <a type="button" href="{{route('admin.product.index')}}"
                            class="btn btn-custom rounded-custom w-fit px-3 py-2 mt-2">
                            بازگشت
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card border p-2">
            <form action="{{route('admin.product-property-spf-tag.create')}}" method="POST"
                enctype="multipart/form-data" @submit.prevent="validateForm">
                @csrf
                @include('CmsCore::product.product.properties-spfs-tags.form')
            </form>
        </div>
    </div>
</div>
@stop
