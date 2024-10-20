@extends('pages.panel.master')
@section('order','active')
@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/panel/panel.css?v.11')}}">
@endpush
@section('content')
<div class="header p-3 d-flex align-items-end justify-content-between">
    <p class="font-md m-0 d-flex align-items-center h3">
        <i class="bi bi-handbag me-2 d-flex"></i>
        سفارش شماره {{$order->id}}
    </p>
    <div class="d-flex align-items-center gap-2">
        <a href="#factor" class="d-flex align-items-center btn btn-one py-2 btn-sm font-th px-3  dynamic-color">مشاهده فاکتور</a>
        <a href="{{route('panel.order-factor',['id'=>$order->id])}}" target="_blank" class="d-flex align-items-center btn btn-two bg-white text-dark shadow-sm py-2 btn-sm font-th px-3">چاپ
            فاکتور</a>

    </div>
</div>

<div class="content px-xl-3 py-2">
    <div class="order-detail">
        <div class="row w-100 m-0">
            <div class="col-xl-6 col-lg-12 col-md-6 p-1">
                <div class="order-info">
                    <p class="font-md">
                        اطلاعات سفارش
                    </p>
                    <div class="info-item d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-calendar4 d-flex me-2"></i>
                            |
                            <p class="m-0 font-re m-0 small ms-2">
                                تاریخ سفارش
                            </p>
                        </div>

                        <p class="font-num m-0">
                            {{@$order->date}}
                        </p>
                    </div>
                    <div class="info-item d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-wallet2 d-flex me-2"></i>
                            |
                            <p class="m-0 font-re m-0 small ms-2">
                                نحوه پرداخت
                            </p>
                        </div>

                        <p class="font-num m-0 small">
                          {{$order->bank->title}}
                        </p>
                    </div>
                    <div class="info-item d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-truck d-flex me-2"></i>
                            |
                            <p class="m-0 font-re m-0 small ms-2">
                                نحوه ارسال
                            </p>
                        </div>

                        <p class="font-num m-0 small">
                            {{@$order->shipping_method->title}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-6 p-1">
                <div class="user-info">
                    <p class="font-md">
                        اطلاعات مشتری
                    </p>
                    <div class="info-item d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-person d-flex me-2"></i>
                            |
                            <p class="m-0 font-re m-0 small ms-2">
                                نام
                            </p>
                        </div>

                        <p class="font-num m-0">
                            {{$order->user->full_name}}
                        </p>
                    </div>
                    <div class="info-item d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-telephone d-flex me-2"></i>
                            |
                            <p class="m-0 font-re m-0 small ms-2">
                                تلفن
                            </p>
                        </div>

                        <p class="font-num m-0 small">
                            {{$order->user->mobile}}
                        </p>
                    </div>
                    <div class="info-item d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-shield d-flex me-2"></i>
                            |
                            <p class="m-0 font-re m-0 small ms-2">
                                وضعیت سفارش
                            </p>
                        </div>

                        <span class="badge bg-transparent border font-re fw-light" style="border-color: {{@$order->shipping_status->color}} !important;color: {{@$order->shipping_status->color}};">
                                                       {{@$order->shipping_status->title}}
                                                </span>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 p-1">
                <div class="address-info">
                    <p class="font-md">
                        اطلاعات آدرس
                    </p>
                    <div class="row w-100 m-0">
                        <div class="col-xl-6 p-1">
                            <div class="info-item d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-geo-alt d-flex me-2"></i>
                                    |
                                    <p class="m-0 font-re m-0 small ms-2">
                                        شهر و استان
                                    </p>
                                </div>

                                <p class="font-num m-0 small">
                                        {{json_decode(@$order->address,true) ? json_decode(@$order->address,true)['state'].' - '.json_decode(@$order->address,true)['city']:  "آدرس نادرست"}}
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-6 p-1">
                            <div class="info-item d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-mailbox-flag d-flex me-2"></i>
                                    |
                                    <p class="m-0 font-re m-0 small ms-2">
                                        کدپستی
                                    </p>
                                </div>

                                <p class="font-num m-0 small">
                                    {{json_decode(@$order->address,true) ? json_decode(@$order->address,true)['postal_code'] :  "آدرس نادرست"}}
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-6 p-1">
                            <div class="info-item d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person d-flex me-2"></i>
                                    |
                                    <p class="m-0 font-re m-0 small ms-2">
                                        نام گیرنده
                                    </p>
                                </div>

                                <p class="font-num m-0 small">
                                    {{@$order->receiptor_full_name}}
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-6 p-1">
                            <div class="info-item d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-telephone d-flex me-2"></i>
                                    |
                                    <p class="m-0 font-re m-0 small ms-2">
                                        تلفن گیرنده
                                    </p>
                                </div>

                                <p class="font-num m-0 small">
                                    {{json_decode(@$order->address,true) ? json_decode(@$order->address,true)['receiptor_mobile'] :  "آدرس نادرست"}}
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-12 p-1">
                            <div class="info-item d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-map d-flex me-2"></i>
                                    |
                                    <p class="m-0 font-re m-0 small ms-2">
                                        آدرس
                                    </p>
                                </div>

                                <p class="font-num m-0 small">
                                    {{json_decode(@$order->address,true) ? json_decode(@$order->address,true)['address'] :  "آدرس نادرست"}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 p-1 mt-3" id="factor">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">ردیف</th>
                                <th scope="col">محصول</th>
                                <th scope="col">تصویر</th>
                                <th scope="col">تعداد</th>
                                <th scope="col">قیمت (واحد)</th>
                                <th scope="col">قیمت</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                        @foreach($order->items as $key=>$row)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>
                                    <a class="text-dark" href="{{ route('product.detail', ['url' => @$row->product->url]) }}" target="_blank">
                                    {{$row->product->title}}/
                                    {{@$row->product_variant->specification->title}}
                                    </a>
                                </td>
                                <td>
                                    <img src="{{@$row->product_variant_id ? (\Rahweb\CmsCore\Modules\Product\Services\VariantService::getProductImagesSizeSeperated(@$row->product_variant->images)[0]['image_medium']
                                        ?? @$row->product->getImage()) : @$row->product->getImage()}}" width="50" alt="pro" title="pro"
                                         loading="lazy">
                                </td>
                                <td>   {{@$row->quantity}}</td>

                                <td>
                                    {{intval($row->discounted_price) != 0 ? number_format(@$row->discounted_price) : number_format(@$row->price)}} <span class="font-th font-small">تومان</span>
                                    @if(intval($row->discounted_price) != 0)
                                        <del>
                                            {{number_format(@$row->price)}} <span class="font-th font-small">تومان</span>
                                        </del>
                                    @endif

                                </td>
                                <td>{{number_format(intval($row->discounted_price) != 0 ? @$row->discounted_price * @$row->quantity : @$row->price * @$row->quantity)}} <span class="font-th font-small">تومان</span></td>

                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="text-center">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>جمع کل</td>
                                <td> {{number_format($order->total_price)}}تومان</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>هزینه ارسال</td>
                                <td>  {{number_format($order->shipping_price)}}تومان</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>تخفیف</td>
                                <td>{{$order->discount_id ? number_format($order->discount_price).' تومان ' : 'ندارد'}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th>مبلغ پرداختی</th>
                                <th>{{number_format($order->payment_price)}} تومان</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

