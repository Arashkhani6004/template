<div class="col-xl-9 col-lg-8 ps-0 pe-0 pe-lg-2 mt-4">
    <div class="addresses bg-white shadow-sm p-3 rounded-4">
        <div class="d-flex align-items-center justify-content-between">
            <p class="font-bold m-0">اقلام سفارش</p>
        </div>
        <hr class="my-2">
        <div class="row w-100 m-0">
            @foreach($items->toArray(request())['data'] as $item)
            <div class="col-xl-4 col-6 p-1">
                <div class="address-item p-2 border position-relative">
                    <img src="{{$item['product_image']}}" class="w-100 rounded-4" alt="{{$item['product_title']}}" title="{{$item['product_title']}}" loading="lazy">
                    <div class="name mt-2 ">
                        <p class="font-bold mb-1 h6">
                            {{$item['product_title']}}
                        </p>
                        @if($item['percent'])
                        <div class="d-flex align-items-center mt-2">
                            <p class="font-bold small m-0 me-2"> تخفیف : </p>
                            <p class=" font-num-r text-uppercase mb-1 small op-lighter">
                                {{@$item['percent']}}%
                            </p>

                        </div>
                        @endif
                    </div>
                    <div class="variables mt-2">
                        @if(@$item['variant_color'])
                        <div class="d-flex align-items-center mt-2">
                            <p class="font-bold small m-0 me-2"> {{@$item['main_variant_title']}} : </p>
                            <div class="d-flex align-items-center ">
                                <div class="color me-2" style="background-color: {{@$item['variant_color']}};">
                                </div>
                                <p class="font-th small m-0">
                                    {{@$item['variant_title']}}
                                </p>
                            </div>
                        </div>
                        @endif
                        <div class="d-flex align-items-center mt-2">
                            <p class="font-bold small m-0 me-2"> تعداد : </p>
                            <p class="font-num-r small m-0">
                                {{@$item['quantity']}}عدد
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
