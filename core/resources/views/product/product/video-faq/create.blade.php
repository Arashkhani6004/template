@extends('CmsCore::_layouts.master')
@section('title',' اضافه کردن ویدیو و سوالات متداول به '.$product->title)
@section('content')
    <div class="body d-flex py-3">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div
                            class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bolder mb-0">
                                سوالات متداول و ویدیو های {{$product->title}}
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
            <div class="card border-0 p-3">
                <form
                    action="{{route('admin.product-video-faq.create')}}"
                    method="POST"
                    enctype="multipart/form-data"
                    id="cms-form-video-faq"
                    @submit.prevent="validateForm"
                >
                    @csrf
                    @include('CmsCore::product.product.video-faq.form')
                </form>
            </div>
        </div>
    </div>
@stop

