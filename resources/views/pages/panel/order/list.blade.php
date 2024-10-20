@extends('pages.panel.master')
@section('order','active')
@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/panel/panel.css?v.1')}}">
@endpush
@section('content')
<div class="header p-3">
    <p class="font-md m-0 d-flex align-items-center h3">
        <i class="bi bi-handbag me-2 d-flex"></i>
        سفارشات
    </p>
</div>
<div class="content px-xl-3 py-2">
    <div class="row w-100 m-0">
        <div class="col-xl-12 p-0">
            <div class="orders">
                <div class="header border-bottom mb-2 d-md-block d-none">
                    <div class="row w-100 m-0">
                        <div class="col-2 p-1 text-center">
                            <p class="font-bold font-small m-0">شماره</p>
                        </div>
                        <div class="col p-1 text-center">
                            <p class="font-bold font-small m-0">اقلام</p>
                        </div>
                        <div class="col p-1 text-center">
                            <p class="font-bold font-small m-0">مبلغ سفارش</p>
                        </div>
                        <div class="col-3 p-1 text-center">
                            <p class="font-bold font-small m-0">وضعیت</p>
                        </div>
                        <div class="col-2 p-1 text-center">

                        </div>
                    </div>
                </div>
                <div class="row w-100 m-0">
                    <div class="col-xxl-12 col-12 p-1">
                       @foreach($user->orders as $order)
                        <div class="order-item">
                            <a href="{{route('panel.order-detail',['id'=>$order->id])}}" class="text-dark">
                                <div class="d-md-block d-none">
                                    <div class="row w-100 m-0">
                                        <div class="col-2 p-1 align-self-center text-center">
                                            <p class="font-num m-0 small">
                                                {!! @$order['id'] !!}
                                            </p>
                                        </div>
                                        <div class="col p-1">
                                            <ul class="p-0 m-0 d-flex align-items-center justify-content-center">
                                                @foreach($order->items as $item)
                                                <li class="order-img">
                                                    <img src="{{@$item->product_variant_id ? (\Rahweb\CmsCore\Modules\Product\Services\VariantService::getProductImagesSizeSeperated($item->product_variant->images)[0]['image_medium'] ?? '/assets/notfounds/product-img.jpg') : @$item->product->getImage()}}"
                                                         alt="{{@$item->product->title}}" title="{{@$item->product->title}}" loading="lazy">
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col p-1 align-self-center text-center">
                                            <p class="font-num fw-bold m-0">
                                                    {{number_format($order['payment_price'])}} تومان
                                            </p>
                                        </div>
                                        <div class="col-3 p-1 align-self-center text-center">
                                            <span class="badge bg-transparent border font-re fw-light" style="border-color: {{@$order->shipping_status->color}} !important;color: {{@$order->shipping_status->color}};">
                                             {{@$order->shipping_status->title}}
                                            </span>
                                        </div>
                                        <div class="col-2 p-1 align-self-center text-center">
                                            <span class="btn btn-sm btn-outline-dark rounded-4">
                                            مشاهده جزئیات
                                            </sapn>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-none d-block">
                                    @foreach($user->orders as $order)
                                    <div class="row w-100 m-0">
                                        <div class="col-6 p-1">
                                            <p class="small font-re m-0">
                                                شماره : <span class="font-num">{!! @$order['id'] !!}</span>
                                            </p>
                                        </div>
                                        <div class="col-6 p-1">
                                            <div class="d-flex align-items-center justify-content-end">

                                            <span class="badge bg-transparent border font-re fw-light" style="border-color: {{@$order->shipping_status->color}} !important;color: {{@$order->shipping_status->color}};">
                                                       {{@$order->shipping_status->title}}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-12 p-1 mt-2">
                                            <ul class="p-0 m-0 d-flex align-items-center justify-content-center">
                                                @foreach($order->items as $item)
                                                    <li class="order-img">
                                                        <img src="{{@$item->product_variant_id ? (\Rahweb\CmsCore\Modules\Product\Services\VariantService::getProductImagesSizeSeperated($item->product_variant->images)[0]['image_medium'] ?? '/assets/notfounds/product-img.jpg') : @$item->product->getImage()}}"
                                                             alt="{{@$item->product->title}}" title="{{@$item->product->title}}" loading="lazy">
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                        <div class="col-9 p-1 mt-2">
                                            <p class="font-num m-0 fw-bolder">
                                                مبلغ سفارش :
                                                <span class="font-num">
                                                    {{number_format($order['payment_price'])}} تومان
                                                </span>

                                            </p>
                                        </div>
                                        <div class="col-3 p-1 align-self-center mt-2">
                                            <a href="{{route('panel.order-detail',['id'=>$order->id])}}" class="font-small btn btn-one btn-sm px-2 py-1 m-0 d-flex align-items-center justify-content-center">
                                                <i class="bi bi-eye d-flex me-1"></i>
                                                مشاهده
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
