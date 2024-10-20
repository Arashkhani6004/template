<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="{{asset('assets/site/css/shared/bootstrap.rtl.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/shared/public.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/panel/panel.css?v.1')}}">
</head>

<body>




    <div class="col-lg-12 p-1">
        <div class="header p-3 d-flex align-items-end justify-content-between">
            <button class="print-button btn btn-one py-2" id="print-button">
                چاپ فاکتور
            </button>
        </div>
        <div class="content px-xl-3 py-2">
            <div class="order-detail factor">
                <div class="row w-100 m-0">
                    <table>
                        <thead>
                            <tr>
                                <th colspan="3" style="text-align: center;">
                                    <h6>صورتحساب فروش کالا</h4>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="" style="text-align:right;align-content:center">
                                    <img src="{{@$settings['logo']}}" width="150">

                                </th>

                                <th colspan="" style="text-align: left;align-content:center">
                                    <p style="font-size: 13px;"> تاریخ :      {{@$order->date}}</p>
                                    <p style="font-size: 13px;">ساعت : {{@$order->time}}</p>
                                    <p style="font-size: 13px;">شماره فاکتور : {{@$order->id}}</p>
                                    <p style="font-size: 13px;"> روش ارسال :    {{@$order->shipping_method->title}}</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="text-align: center;background:#f8f8f8;padding:8px 0;">
                                <td colspan="3">
                                    <h6 style="margin: 0;padding:8px">اطلاعات فروشنده</h5>
                                </td>
                            </tr>
                            <tr style="border: 1px solid #ddd;">
                                <td style="text-align:right">
                                    <p style="display: flex;align-items:center;margin:0;padding:8px;font-size:13px">
                                        <span style="font-weight: bolder;">نام فروشگاه :</span>
                                        {{@$settings['siteName_fa']}}
                                    </p>
                                </td>
                                <td style="text-align:left">
                                    <p style="display: flex;align-items:center;justify-content:flex-end;margin:0;padding:8px;font-size:13px">
                                        <span style="font-weight: bolder;">تلفن فروشگاه :</span>
                                        {{@$settings['main_phone_number']}}
                                    </p>
                                </td>
                            </tr>
                            {{--<tr style="border: 1px solid #ddd;border-top:0">
                                <td>
                                    <p style="display: flex;align-items:center;justify-content:flex-start;margin:0;padding:8px">
                                        <span style="font-weight: bolder;">نشانی فروشگاه :</span>
                                        تهران-تهرانپارس-فلکه اول -کوچه ۱۵۲ شرقی
                                    </p>
                                </td>
                                <td style="text-align:left">
                                    <p style="display: flex;align-items:center;justify-content:flex-end;margin:0;padding:8px">
                                        <span style="font-weight: bolder;">کدپستی فروشگاه :</span>
                                        ۱۲۳۴۵۶۷۸۹۰
                                    </p>
                                </td>
                            </tr>--}}
                            <tr style="text-align: center;background:#f8f8f8;padding:8px 0;">
                                <td colspan="3">
                                    <h6 style="margin: 0;padding:8px">اطلاعات گیرنده</h6>
                                </td>
                            </tr>
                            <tr style="border: 1px solid #ddd;">
                                <td style="text-align:right">
                                    <p style="display: flex;align-items:center;margin:0;padding:8px;font-size:13px">
                                        <span style="font-weight: bolder;">نام گیرنده :</span>
                                        {{@$order->receiptor_full_name}}
                                    </p>
                                </td>
                                <td style="text-align:left">
                                    <p style="display: flex;align-items:center;justify-content:flex-end;margin:0;padding:8px;font-size:13px">
                                        <span style="font-weight: bolder;">تلفن گیرنده :</span>
                                        {{json_decode(@$order->address,true) ? json_decode(@$order->address,true)['receiptor_mobile'] :  "آدرس نادرست"}}
                                    </p>
                                </td>
                            </tr>
                            <tr style="border: 1px solid #ddd;border-top:0">
                                <td>
                                    <p style="display: flex;align-items:center;justify-content:flex-start;margin:0;padding:8px;font-size:13px">
                                        <span style="font-weight: bolder;">نشانی گیرنده :</span>
                                        {{json_decode(@$order->address,true) ? json_decode(@$order->address,true)['address'] :  "آدرس نادرست"}}
                                    </p>
                                </td>
                                <td style="text-align:left">
                                    <p style="display: flex;align-items:center;justify-content:flex-end;margin:0;padding:8px;font-size:13px">
                                        <span style="font-weight: bolder;">کدپستی گیرنده :</span>
                                        {{json_decode(@$order->address,true) ? json_decode(@$order->address,true)['postal_code'] :  "آدرس نادرست"}}
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="" style="padding: 0;" id="factor">
                        <div class="table-responsive">
                            <table class="table align-middle" style="border: 1px solid #ddd;border-top:0">
                                <thead class="text-center">
                                    <tr>
                                        <th colspan="6" style="text-align: center;background:#f8f8f8">
                                            <h6 style="margin: 0;padding:8px">اطلاعات محصولات</h6>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th scope="col" style="font-size: 14px;">ردیف</th>
                                        <th scope="col" style="font-size: 14px;">محصول</th>
                                        <th scope="col" style="font-size: 14px;">تصویر</th>
                                        <th scope="col" style="font-size: 14px;">تعداد</th>
                                        <th scope="col" style="font-size: 14px;">قیمت (واحد)</th>
                                        <th scope="col" style="font-size: 14px;">قیمت</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach($order->items as $key=>$row)
                                    <tr>
                                        <th scope="row" style="font-size: 13px;">{{$key+1}}</th>
                                        <td style="font-size: 13px;">
                                            {{@$row->product->title}}/
                                            {{@$row->product_variant->specification->title}}
                                        </td>
                                        <td style="font-size: 13px;">
                                            <img src="{{@$row->product_variant_id ? (\Rahweb\CmsCore\Modules\Product\Services\VariantService::getProductImagesSizeSeperated(@$row->product_variant->images)[0]['image_medium']
                                                ?? @$row->product->getImage()) : @$row->product->getImage()}}" width="50" alt="pro" title="pro"
                                                loading="lazy">
                                        </td style="font-size: 13px;">
                                        <td style="font-size: 13px;"> {{@$row->quantity}}</td>
                                        <td style="font-size: 13px;">
                                            {{intval($row->discounted_price) != 0 ? number_format(@$row->discounted_price) : number_format(@$row->price)}} <span class="font-th font-small">تومان</span>
                                            @if(intval($row->discounted_price) != 0)
                                            <del>
                                                {{number_format(@$row->price)}} <span class="font-th font-small">تومان</span>
                                            </del>
                                            @endif

                                        </td>
                                        <td style="font-size: 13px;">{{number_format(intval($row->discounted_price) != 0 ? @$row->discounted_price * @$row->quantity : @$row->price * @$row->quantity)}} <span class="font-th font-small">تومان</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="text-center">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="font-size: 13px;">جمع کل</td>
                                        <td style="font-size: 13px;"> {{number_format(@$order->total_price)}}تومان</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="font-size: 13px;">هزینه ارسال</td>
                                        <td style="font-size: 13px;"> {{number_format(@$order->shipping_price)}}تومان</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="font-size: 13px;">تخفیف</td>
                                        <td style="font-size: 13px;">{{$order->discount_id ? number_format($order->discount_price).' تومان ' : 'ندارد'}}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th style="font-size: 13px;">مبلغ پرداختی</th>
                                        <th style="font-size: 13px;">{{number_format($order->payment_price)}} تومان</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var printButton = document.getElementById('print-button');
        printButton.addEventListener('click', function() {
            window.print();
        })
    </script>
</body>

</html>
