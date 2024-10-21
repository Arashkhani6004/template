@extends('CmsCore::_layouts.master')

@section('title')
سفارش ها
@stop
@section('content')
<div class="body d-flex py-3">
    <div class="container-fluid">
        <div class="page-header">
            <div class="card-header py-3 no-bg bg-transparent border-0 px-0 flex-wrap">
                <h3 class="fw-bolder mb-0">
                    سفارش ها
                </h3>
                <div class="d-flex flex-md-row flex-column align-items-md-center justify-content-md-between w-100">
{{--                    <a href="{{route('admin.shipping-method.create')}}"--}}
{{--                        class="btn ms-2 my-2 btn-custom-b rounded-custom d-flex align-items-center w-fit">--}}
{{--                        <i class="bi bi-plus-square-dotted d-flex h5 my-0 me-2"></i>--}}
{{--                        افزودن سفارش--}}
{{--                    </a>--}}
                    <ul class="list-inline align-items-center m-0">
                        <li class="list-inline-item mx-0">
                            <a data-bs-target="#searchModal" data-bs-toggle="modal"
                               class="btn my-2 btn-custom rounded-custom d-flex align-items-center">
                                <i class="bi bi-search d-flex my-0 me-2"></i>
                                جستجوی پیشرفته
                            </a>
                        </li>
                    </ul>

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
                                    {{-- <th>--}}
                                        {{-- <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault">--}}
                                        {{-- </th>--}}
                                    <th class="fw-bolder">
                                        #
                                    </th>
                                    <th class="fw-bolder">
                                        شماره سفارش
                                    </th>
                                    <th class="fw-bolder">
                                        نام کاربر
                                    </th>
                                    <th class="fw-bolder">
                                      مبلغ پرداختی
                                    </th>
                                    <th class="fw-bolder">
                                      روش ارسال
                                    </th>
                                    <th class="fw-bolder" style="width: 10%;">
                                        تاریخ
                                    </th>
                                    <th class="fw-bolder">
                                        وضعیت
                                    </th>
                                    <th class="fw-bolder">
                                        عملیات
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-center text-light">
                                @foreach($orders as $key=>$row)
                                <tr>
                                    {{-- <th>--}}
                                        {{-- <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckChecked">--}}
                                        {{-- </th>--}}
                                    <th>
                                        {{$key + 1}}
                                    </th>
                                    <th>
                                        <span style="font-size: 14px">
                                            {{$row['id']}}
                                        </span>
                                    </th>
                                    <th>
                                        <span style="font-size: 14px">
                                            {{$row->user->full_name}}
                                        </span>
                                    </th>
                                    <th>
                                        <span class="badge bg-label-primary" style="font-size: 14px">
                                            {{number_format(@$row->payment_price)}} تومان
                                        </span>
                                    </th>
                                    <th>
                                        <span class="badge bg-label-primary" style="font-size: 14px">
                                            {{@$row->shipping_method->title}}
                                        </span>
                                    </th>
                                    <th>
                                        {{@$row->date}}
                                    </th>
                                    <th>
                                    <span class="badge" style="background-color: {{@$row->shipping_status->color}}" style="font-size: 14px">
                                            {{@$row->shipping_status->title}}
                                        </span>
                                        <span class="badge bg-label-info" style="font-size: 14px">
                                            {{@$row->status_name}}
                                        </span>

                                    </th>
                                    <th>
                                        <div class="btn-group" role="group">
                                            <a class="d-flex me-2 align-items-center" data-bs-toggle="tooltip"
                                                data-bs-title="جزییات"
                                                href="{{route('admin.order.detail',['id'=>$row->id])}}">
                                                <i class="d-flex bi bi-eye color-custom2 fs-5"></i>
                                            </a>
{{--                                            <a class="d-flex me-2 align-items-center" data-bs-toggle="tooltip"--}}
{{--                                                data-bs-title="حذف"--}}
{{--                                                onclick="confirmDelete('{{route('admin.shipping-method.delete',['id'=>$row->id])}}')"--}}
{{--                                                href="#">--}}
{{--                                                <i class="d-flex bi bi-trash3 color-custom2 fs-5"></i>--}}
{{--                                            </a>--}}
                                        </div>
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @component("CmsCore::components.pagination.default")
                    @slot("paginator",$orders)
                    @endcomponent
                </form>
            </div>
        </div>
    </div>
    @stack('modals')
</div>
@include('CmsCore::order.order.search')
@endsection
@push('scripts')
@include('CmsCore::_layouts.blocks.utils.confirmDelete')
@endpush
