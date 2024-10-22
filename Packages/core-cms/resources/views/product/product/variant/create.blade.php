@extends('CmsCore::_layouts.master')
@section('title') متغییر های {{$product->title}}@stop
@section('content')
<div class="body d-flex py-3">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div
                        class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bolder mb-0">
                            متغییر های {{$product->title}}
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
            @include('CmsCore::product.product.variant.main-variant-form')
        </div>
        <div class="card border p-2">
            @if($product->main_variant_specification_id != null)
            <form action="{{route('admin.product-variant.create')}}" method="POST"
                enctype="multipart/form-data" @submit.prevent="validateForm">
                @csrf
                @include('CmsCore::product.product.variant.form')
            </form>
                @else
                <div class="text-dark justify-content-center text-center">
                    <p>
                        ابتدا متغییر اصلی {{@$product->title}} را مشخص کنید
                    </p>
                </div>

                    @endif
        </div>
    </div>
</div>
@stop
