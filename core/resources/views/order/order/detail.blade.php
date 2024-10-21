@extends('CmsCore::_layouts.master')

@section('title') جزییات سفارش @stop
@section('content')
    <div class="row w-100 m-0 mt-5">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header" style="color: #3c8dbc;">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    اطلاعات کاربر
                </h5>

                <div class="card-body px-1">
                    <div class="table-responsive">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row w-100 m-0">
                                <div class="col-sm-12">
                                    <table class="table table-striped table-bordered first dataTable" id="DataTables_Table_0"
                                           role="grid" aria-describedby="DataTables_Table_0_info">

                                        <tbody>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                                colspan="1" style="width: 80.0667px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">
                                                نام کاربر
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                                colspan="1" style="width: 80.0667px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">
                                             {{$data->user->full_name}}

                                            </th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                                colspan="1" style="width: 80.0667px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">
                                                کد کاربر
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                                colspan="1" style="width: 80.0667px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">
                                                {{$data->user->id}}
                                            </th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1" style="width: 80.0667px;"
                                                aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                نام گیرنده
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 80.0667px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">
                                                {{$data->receiptor_full_name}}
                                            </th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1" style="width: 80.0667px;"
                                                aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                تلفن گیرنده
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 80.0667px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">
                                                {{json_decode(@$data->address,true) ? json_decode(@$data->address,true)['receiptor_mobile'] :  "آدرس نادرست"}}

                                            </th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 80.0667px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">
                                                شماره همراه کاربر
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 80.0667px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending" dir="ltr">
                                                {{$data->user->mobile}}
                                            </th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                                colspan="1" style="width: 80.0667px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">کد پستی
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                                colspan="1" style="width: 80.0667px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">
                                                {{json_decode(@$data->address,true) ? json_decode(@$data->address,true)['postal_code'] :  "آدرس نادرست"}}
                                            </th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                                colspan="1" style="width: 80.0667px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">آدرس
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                                colspan="1" style="width: 80.0667px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">
                                                {{json_decode(@$data->address,true) ? json_decode(@$data->address,true)['address'] :  "آدرس نادرست"}}

                                            </th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{route('admin.order.factor',['id'=>$data->id])}}" type="button" class="btn btn-custom rounded-custom w-fit my-3"
               data-toggle="tooltip" target="_blank" title="" data-original-title="نسخه قابل چاپ">
                <i class="fa fa-print"> نسخه قابل چاپ</i>
            </a>


        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header" style="color: #3c8dbc;">
                    <i class="fa fa-file" aria-hidden="true"></i>
                    اطلاعات فاکتور
                </h5>
                <div class="card-body px-1">
                    <div class="table-responsive">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row w-100 m-0">
                                <div class="col-sm-12">
                                    <table class="table table-striped table-bordered first dataTable" id="DataTables_Table_0"
                                           role="grid" aria-describedby="DataTables_Table_0_info">
                                        <tbody>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                شماره سفارش
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                               {{$data->id}}
                                            </th>
                                        </tr>

                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                روش ارسال
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                {{$data->shipping_method->title}}
                                            </th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                درگاه پرداخت
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                {{$data->bank->title}}
                                            </th>
                                        </tr>

                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                مبلغ کل
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                {{number_format($data->total_price) . ' تومان '}}
                                            </th>
                                        </tr>

                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                هزینه ارسال
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                {{number_format($data->shipping_price) . ' تومان '}}
                                            </th>
                                        </tr>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                کد تخفیف/مبلغ تخفیف
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                {{$data->discount_id ? number_format($data->discount_price) . ' تومان ' : 'ندارد'}}</th>
                                        </tr>

                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                مبلغ پرداختی
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                {{number_format($data->payment_price) . ' تومان '}}</th>
                                        </tr>

                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                وضعیت پرداخت
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                    <span class="badge" style="background-color:#6c757d                                                                                                                                                                   ">
                                                     {{$data->status_name}}
                                                    </span>
                                            </th>
                                        </tr>
                                        <tr role="row">
                                            <form action="{{route('admin.order.change-shipping-status',['id'=>$data->id])}}" method="POST">
                                          @csrf
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                وضعیت
                                                ارسال
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 80.0667px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                    <select name="shipping_status_id" class="w-100 form-select bg-light rounded-custom " >
                                                        @foreach($shipping_statuses as $shipping_status)
                                                            <option @if($data->shipping_status_id == $shipping_status->id) selected @endif
                                                            value="{{$shipping_status->id}}">{{$shipping_status->title}}</option>
                                                        @endforeach
                                                        </select>
                                                <div class="w-100 pe-0">
                                                    <button type="submit" id="submitFormCms" class="btn btn-custom rounded-custom w-fit px-3 py-2">
                                                        ذخیره
                                                    </button>
                                                </div>
                                                </form>
                                            </th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
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
                                        عنوان
                                    </th>
                                    <th class="fw-bolder" style="width: 10%;">
                                        تصویر
                                    </th>
                                    <th class="fw-bolder" style="width:100px">
                                        قیمت
                                    </th>
                                    <th class="fw-bolder">
                                        تعداد
                                    </th>


                                </tr>
                                </thead>
                                <tbody class="text-center text-light">
                                @foreach($data->items as $key=>$row)
                                    <tr>
                                        {{-- <th>--}}
                                        {{-- <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckChecked">--}}
                                        {{-- </th>--}}
                                        <th>
                                            {{$key + 1}}
                                        </th>
                                        <th>
                                            <a href="{{url('/product/'.@$row->product->url)}}" target="_blank">
                                        <span style="font-size: 11px">

                                            {{$row->product->title}}/
                                            {{@$row->product_variant->specification->title}}
                                        </span>
                                            </a>
                                        </th>
                                        <th>
                                            <img src="{{@$row->product_variant_id ? (\Rahweb\CmsCore\Modules\Product\Services\VariantService::getProductImagesSizeSeperated(@$row->product_variant->images)[0]['image_medium']
                                                ?? @$row->product->getImage()) : @$row->product->getImage()}}" class="border shadow rounded"
                                                 style="width:50px">
                                        </th>
                                        <th>
                                        <span class="badge bg-label-primary">
                                            @if(@$row->product_variant_id != null)
                                                {{number_format($row->product_variant->final_price)}} تومان/
                                                @if($row->product_variant->discounted_price != 0)
                                                    <del>
                                     {{number_format($row->product_variant->price)}} تومان

                                                </del>
                                                @endif
                                            @else
                                                {{number_format($row->product->final_price)}} تومان/
                                                @if($row->product->discounted_price != 0)
                                                    <del>
                                     {{number_format($row->product->price)}} تومان

                                                </del>
                                            @endif
                                            @endif


                                        </span>
                                        </th>
                                        <th>
                                            {{@$row->quantity}}
                                        </th>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                </div>
            </div>
        </div>

    </div>
@stop
@push('scripts')
<script src="{{asset('assets/admin/js/vue.js')}}"></script>
<script src="{{asset('assets/admin/js/validations.js')}}"></script>
@endpush
