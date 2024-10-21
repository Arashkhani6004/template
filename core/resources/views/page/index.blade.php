@extends('CmsCore::_layouts.master')

@section('title')
صفحات
@stop
@section('content')
<div class="body d-flex py-3" id="cms-form">
    <div class="container-fluid">
        <div class="page-header">
            <div class="card-header py-3 no-bg bg-transparent border-0 px-0 flex-wrap">
                <h3 class="fw-bolder">
                    صفحات
                </h3>
                <div class="d-flex flex-md-row flex-column align-items-md-center justify-content-md-between w-100">
                    <a href="{{route('admin.page.create')}}"
                        class="btn ms-2 my-2 btn-custom-b rounded-custom d-flex align-items-center w-fit">
                        <i class="bi bi-plus-square-dotted d-flex h5 my-0 me-2"></i>
                        افزودن صفحه
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card-block row">
            <div class="col-sm-12 col-lg-12 col-xl-12">
                <form class="form-control">
                    <div class="table-responsive  d-flex align-items-center">
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
                                        عنوان
                                    </th>
                                    <th class="fw-bolder">
                                        تصویر
                                    </th>
                                    <th class="fw-bolder">
                                        دسته
                                    </th>
                                    <th class="fw-bolder">
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
                                @foreach($page as $key=>$row)
                                @php
                                $main =
                                Rahweb\CmsCore\Modules\Page\Entities\Page::where('id',@$row['id'])->select(['image','updated_at','id','show_in_first_page'])->first();

                                @endphp
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
                                            {{$row['title']}}
                                        </span>
                                    </th>
                                    <th>
                                        <img src="{{@$main->item_image}}" class="border shadow rounded"
                                            style="width:50px">
                                    </th>
                                    <th>
                                        @if($row['parent_id'] == null)
                                        <span class="badge  bg-label-info" style="font-size: 11px">
                                            دسته اصلی
                                        </span>
                                        @else
                                        @php
                                        $cat =
                                        Rahweb\CmsCore\Modules\Page\Entities\Page::where('id',@$row['parent_id'])->select('title')->first();
                                        @endphp
                                        <span class="badge  bg-label-primary" style="font-size: 11px">
                                            {{@$cat->title}}
                                        </span>
                                        @endif
                                    </th>
                                    <th>
                                        <span style="font-size: 14px">
                                            {{@$main->date}}
                                        </span>
                                    </th>
                                    <th>
                                        <span class="badge bg-label-{{$main->first_page_name['badge']}}"
                                            style="font-size: 11px">
                                            {{@$main->first_page_name['title']}}
                                        </span>
                                    </th>
                                    <th>
                                        <div class="btn-group" role="group">
                                            @include('CmsCore::seo.seo.form', ['data' => $main])
                                            <a class="d-flex me-2 align-items-center" data-bs-toggle="tooltip"
                                                data-bs-title="ویرایش"
                                                href="{{route('admin.page.edit',['id'=>$main->id])}}">
                                                <i class="d-flex bi bi-pencil-square color-custom2 fs-5"></i>
                                            </a>
                                            <a class="d-flex me-2 align-items-center" data-bs-toggle="tooltip"
                                                data-bs-title="حذف"
                                                onclick="confirmDelete('{{route('admin.page.delete',['id'=>$main->id])}}')"
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
                    @component("CmsCore::components.pagination.default")
                    @slot("paginator",$page)
                    @endcomponent
                </form>
            </div>
        </div>
    </div>
    @stack('modals')
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
                    <div class="row w-100 m-0">
                        <div class="col-md-6 p-2">
                            <div class="form-group">
                                <label>
                                    عنوان
                                </label>
                                <input name="title" id="" class="form-control rounded-custom">
                            </div>
                        </div>
                        <div class="col-md-6 p-2">
                            <div class="form-group">
                                <label>
                                    دسته
                                </label>
                                <select name="parent_id" id="" class="form-select rounded-custom">
                                    @foreach ($category as $cat)
                                    <option value="{{$cat['id']}}">
                                        {{$cat['title']}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 ms-auto p-2">
                            <button type="submit" id="submitFormCms"
                                class="btn btn-custom rounded-custom w-fit px-4 ms-auto mt-3">
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
