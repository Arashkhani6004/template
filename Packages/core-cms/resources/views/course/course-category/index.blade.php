@extends('CmsCore::_layouts.master')

@section('title')
دسته بندی دوره ها
@stop
@section('content')
<div class="body d-flex py-3">
    <div class="container-fluid">
        <div class="page-header">
            <div class="card-header py-3 no-bg bg-transparent border-0 px-0 flex-wrap">
                <h3 class="fw-bolder">
                    دسته بندی دوره ها
                </h3>
                <div class="d-flex flex-md-row flex-column align-items-md-center justify-content-md-between w-100">
                    <a href="{{url('admin/course-category/create')}}"
                        class="btn ms-2 my-2 btn-custom-b rounded-custom d-flex align-items-center w-fit">
                        <i class="bi bi-plus-square-dotted d-flex h5 my-0 me-2"></i>
                        افزودن دسته بندی
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card-block row">
            <div class="col-sm-12 col-lg-12 col-xl-12">
                <form class="form-control">
                    <div class="table-responsive d-flex align-items-center">
                        <table id="myDataTable" class="table align-middle border-custom mb-0">
                            <thead class="text-center text-light">
                                <tr>
                                    <th>
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    </th>
                                    <th class="fw-bolder">
                                        #
                                    </th>
                                    <th class="fw-bolder">
                                        عنوان
                                    </th>
                                    <th class="fw-bolder">
                                        تصویر
                                    </th>
                                    <th class="fw-bolder">
                                        وضعیت
                                    </th>
                                    <th class="fw-bolder">
                                        تاریخ
                                    </th>
                                    <th class="fw-bolder">
                                        عملیات
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-center text-light">
                                @foreach($course_category as $key=>$row)
                                <tr>
                                    <th>
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                    </th>
                                    <th>
                                        {{$key + 1}}
                                    </th>
                                    <th>
                                        <span style="font-size: 14px">
                                            {{$row['title']}}
                                        </span>
                                    </th>
                                    <th>
                                        <img src="{{@$row->item_image}}" class="border shadow rounded"
                                            style="width:50px">
                                    </th>
                                    <th>
                                        @if(@$row->active == 1)
                                        <span class="badge  bg-label-success" style="font-size: 11px">
                                            فعال
                                        </span>
                                        @else
                                        <span class="badge  bg-label-danger" style="font-size: 11px">
                                            غیر فعال
                                        </span>
                                        @endif
                                    </th>
                                    <th>
                                        {{@$row->date}}
                                    </th>
                                    <th>

                                        <div class="btn-group" role="group">
                                            @include('CmsCore::seo.seo.form', ['data' => $row])
                                            <a class="d-flex me-2 align-items-center" data-bs-toggle="tooltip"
                                                data-bs-title="ویرایش"
                                                href="{{url('admin/course-category/edit/'.$row['id'])}}">
                                                <i class="d-flex bi bi-pencil-square color-custom2 fs-5"></i>
                                            </a>
                                            <a class="d-flex me-2 align-items-center" data-bs-toggle="tooltip"
                                                data-bs-title="حذف"
                                                onclick="confirmDelete('/admin/course-category/delete/{{ @$row['id'] }}')"
                                                href="#">
                                                <i class="d-flex bi bi-trash3 color-custom2 fs-5"></i>
                                            </a>
                                        </div>
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if(count($course_category))
                    @include('CmsCore::components.pagination.default',['paginator'=>$course_category])
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
{{-- search modal --}}
<div id="myModal" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content rounded-custom border-custom shadow bg-white">
            <div class="modal-header px-3 py-2">
                <h4 class="m-0">
                    جستجو
                </h4>
                <button type="button" class="close btn px-0" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg d-flex" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body p-2">
                <form id="cms-form" method="GET" action="{{URL::current()}}" class="m-0">
                    <div class="px-2">
                        <div class="form-group p-0">
                            <label>
                                عنوان
                            </label>
                            <input name="title" id="" class="form-control rounded-custom">
                        </div>
                        <button type="submit" id="submitFormCms"
                            class="btn btn-custom rounded-custom w-fit ms-auto px-4 mt-3">
                            <i class="bi bi-search"></i>
                            جستجو
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@include('CmsCore::_layouts.blocks.utils.confirmDelete')
@endpush
