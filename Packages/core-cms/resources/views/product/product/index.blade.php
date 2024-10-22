@extends('CmsCore::_layouts.master')
@section('title','محصولات')
@section('content')
    <div class="body d-flex py-3" id="cms-form">
        <div class="container-fluid">
            <div class="page-header">
                <div class="card-header py-3 no-bg bg-transparent border-0 px-0 flex-wrap">
                    <h3 class="fw-bolder mb-0">
                        محصولات
                    </h3>
                    <div class="d-flex flex-md-row flex-column align-items-md-center justify-content-md-between w-100">
                        <a href="{{route('admin.product.create')}}"
                           class="btn ms-2 my-2 btn-custom-b rounded-custom d-flex align-items-center w-fit">
                            <i class="bi bi-plus-square-dotted d-flex h5 my-0 me-2"></i>
                            افزودن محصول
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="form-control">
                        <div class="table-responsive d-flex align-items-center">
                            <table id="myDataTable" class="table align-middle border-custom mb-0">
                                <thead class="text-center text-light">
                                <tr>
                                    <th class="fw-bolder">
                                        #
                                    </th>
                                    <th class="fw-bolder">
                                        عنوان
                                    </th>
                                    <th class="fw-bolder" style="width: 10%;">
                                        تصویر
                                    </th>
                                    <th class="fw-bolder" style="width:100px">
                                        برند
                                    </th>
                                    <th class="fw-bolder">
                                        دسته
                                    </th>
                                    <th class="fw-bolder">
                                        وضعیت نمایش
                                    </th>
                                    <th class="fw-bolder">
                                        تاریخ
                                    </th>
                                    <th class="fw-bolder" style="width:250px">
                                        عملیات
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="text-center text-light">
                                @foreach($product as $key=>$row)
                                    <tr>
                                        <th>
                                            {{$key + 1}}
                                        </th>
                                        <th>
                                        <span style="font-size: 11px">
                                            {{$row['title']}}
                                        </span>
                                        </th>
                                        <th>
                                            <img src="{{@$row->getImage()}}" class="border shadow rounded"
                                                 style="width:50px">
                                        </th>
                                        <th>
                                        <span class="badge bg-label-primary">
                                            {{@$row->brand->title}}
                                        </span>
                                        </th>
                                        <th>
                                            @foreach(@$row->categories as $rowCategory)
                                                <span class="badge bg-label-primary"
                                                      style="font-size: 11px">{{$rowCategory->title}}</span>
                                            @endforeach
                                        </th>
                                        <th>
                                            <span class="badge bg-label-{{$row->active_name['badge']}}"
                                                  style="font-size: 11px">
                                                {{@$row->active_name['title']}}
                                            </span>
                                            <span class="badge bg-label-{{$row->first_page_name['badge']}}"
                                                      style="font-size: 11px">
                                                {{@$row->first_page_name['title']}}
                                            </span>
{{--                                            <span class="badge bg-label-{{$row->stock_product['badge']}}"--}}
{{--                                                      style="font-size: 11px">--}}
{{--                                                {{@$row->stock_product['title']}}--}}
{{--                                            </span>--}}
                                        </th>
                                        <th>
                                            {{@$row->date}}
                                        </th>
                                        <th>
                                            <div class="btn-group" role="group">
                                                <a class="d-flex me-2 align-items-center" data-bs-toggle="tooltip"
                                                   data-bs-title="ویرایش"
                                                   href="{{route('admin.product.edit',['id'=>$row->id])}}">
                                                    <i class="d-flex bi bi-pencil-square color-custom2 fs-5"></i>
                                                </a>
                                                <a class="d-flex me-2 align-items-center" data-bs-toggle="tooltip"
                                                   data-bs-title="تصاویر"
                                                   href="{{route('admin.product-image.index',['id'=>$row->id])}}">
                                                    <i class="d-flex bi bi-images color-custom2 fs-5"></i>
                                                </a>
                                                <a class="d-flex me-2 align-items-center" data-bs-toggle="tooltip"
                                                   data-bs-title="متغییر ها"
                                                   href="{{route('admin.product-variant.index',['id'=>$row->id])}}">
                                                    <i class="d-flex bi bi-cash-coin color-custom2 fs-5"></i>
                                                </a>
                                                @include('CmsCore::seo.seo.form', ['data' => $row])
                                                <a class="d-flex me-2 align-items-center" data-bs-toggle="tooltip"
                                                   data-bs-title="ویدیو/سوالات متداول"
                                                   href="{{route('admin.product-video-faq.index',['id'=>$row->id])}}">
                                                    <i class="d-flex bi bi-camera-video color-custom2 fs-5"></i>
                                                </a>
                                                <a class="d-flex me-2 align-items-center" data-bs-toggle="tooltip"
                                                   data-bs-title="مشخصه/ویژگی/فیلتر"
                                                   href="{{route('admin.product-property-spf-tag.index',['id'=>$row->id])}}">
                                                    <i class="d-flex bi bi-tags color-custom2 fs-5"></i>
                                                </a>
                                                @if($row['discounted_price'] != null)
                                                    <button type="button"
                                                            class="btn me-2 p-0 bg-transparent border-0 shadow-none"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal{{$row['id']}}"
                                                            data-bs-title="تایمر شگفت انگیز" title="تایمر شگفت انگیز">
                                                <span data-bs-toggle="tooltip" data-bs-title="تایمر شگفت انگیز">
                                                    <i class="bi bi-clock d-flex color-custom2 fs-5"></i>
                                                </span>
                                                    </button>
                                                @endif
                                                @include('CmsCore::product.product.modal')
                                                <a class="d-flex me-2 align-items-center" data-bs-toggle="tooltip"
                                                   data-bs-title="حذف"
                                                   onclick="confirmDelete('{{route('admin.product.delete',['id'=>$row->id])}}')"
                                                   href="#">
                                                    <i class="d-flex bi bi-trash3 color-custom2 fs-5"></i>
                                                </a>
                                                <a class="d-flex me-2 align-items-center" data-bs-toggle="tooltip"
                                                   data-bs-title="مشاهده" target="_blank"
                                                   href="{{ route('product.detail', ['url' => $row['url']]) }}">
                                                    <i class="d-flex bi bi-eye color-custom2 fs-5"></i>
                                                </a>
                                            </div>
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @component("CmsCore::components.pagination.default")
                            @slot("paginator",$product)
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
        @stack('modals')
    </div>
    <div id="myModal" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
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
                        <div class="row w-100 m-0">
                            <div class="col-lg-4 p-2">
                                <div class="form-group">
                                    <label>
                                        عنوان
                                    </label>
                                    <input name="title" id="" class="form-control rounded-custom">
                                </div>
                            </div>
                            <div class="col-lg-4 p-2">
                                <div class="form-group">
                                    <label>
                                        برند
                                    </label>
                                    <select name="brand_id" id="" class="form-select rounded-custom">
                                        @foreach ($brand as $r)
                                            <option value="{{$r['id']}}">
                                                {{$r['title']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-10 col-12 ms-auto p-2">
                                <button type="submit" id="submitFormCms" class="btn btn-success rounded-custom w-100">
                                    <i class="bi bi-search"></i>
                                    جستجو
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('assets/admin/js/vue.js')}}"></script>
    <script src="{{asset('assets/admin/js/validations.js')}}"></script>
    @include('CmsCore::_layouts.blocks.utils.confirmDelete')
@endpush
