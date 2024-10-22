@extends('CmsCore::_layouts.master')

@section('title')
ویرایش نظر
@stop
@section('content')
<div class="body d-flex py-3">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div
                        class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bolder mb-0">
                            ویرایش
                            نظر ( {{$data->reply_id != null ? 'پاسخ به کامنت ' .@$data->comment->name : "کامنت اصلی"}}
                            )
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card border p-2">
            <form id="cms-form" action="{{url('admin/comment/edit/'.$data->id)}}" method="POST"
                enctype="multipart/form-data" novalidate>
                @csrf
                @include('CmsCore::comment.form')
            </form>
        </div>
    </div>
</div>
@stop
@push('scripts')

@endpush