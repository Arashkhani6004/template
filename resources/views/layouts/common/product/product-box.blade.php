<a href="{{ route('product.detail', ['url' => $product['url']]) }}" class="color-title">
    <div class="product-card">
        @if(@$product->percent)
            <div class="off font-num-r">
                {{$product->percent}}%
            </div>
        @endif
        <div class="row w-100 m-0">
            <div class="col-sm-12 col-4 p-sm-0 p-0">
                <img src="{{$product->getImage('medium')}}" class="w-100" alt="{{$product['title']}}"
                     title="{{$product['title']}}" loading="lazy">

            </div>
            <div class="col-sm-12 col-8 p-sm-0 p-0 align-self-center">
                <div class="p-2">
                    <div class="name text-sm-center">
                        <p class="font-bold m-0">{{$product['title']}}</p>
                    </div>
                    {{-- <div class="colors mt-2">--}}
                    {{-- <ul class="p-0 m-0 d-flex justify-content-center align-items-center gap-2 flex-wrap">--}}
                    {{-- <li class="list-unstyled m-0" style="background-color: red;">--}}

                    {{-- </li>--}}
                    {{-- <li class="list-unstyled m-0" style="background-color: blue;">--}}

                    {{-- </li>--}}
                    {{-- <li class="list-unstyled m-0" style="background-color: antiquewhite;">--}}

                    {{-- </li>--}}
                    {{-- <li class="list-unstyled m-0" style="background-color: rgb(193, 127, 40);">--}}

                    {{-- </li>--}}
                    {{-- <li class="list-unstyled m-0" style="background-color: rgb(208, 0, 215);">--}}

                    {{-- </li>--}}
                    {{-- <li class="list-unstyled m-0" style="background-color: rgb(130, 149, 222);">--}}

                    {{-- </li>--}}
                    {{-- <li class="list-unstyled m-0" style="background-color: rgb(239, 220, 3);">--}}

                    {{-- </li>--}}
                    {{-- <li class="list-unstyled m-0" style="background-color: rgb(170, 170, 170);">--}}

                    {{-- </li>--}}
                    {{-- <li class="list-unstyled m-0" style="background-color: rgb(223, 127, 0);">--}}

                    {{-- </li>--}}
                    {{-- <li class="list-unstyled m-0" style="background-color: rgb(165, 99, 156);">--}}

                    {{-- </li>--}}
                    {{-- <li class="list-unstyled m-0" style="background-color: rgb(48, 125, 202);">--}}

                    {{-- </li>--}}
                    {{-- <li class="list-unstyled m-0" style="background-color: rgb(83, 140, 45);">--}}

                    {{-- </li>--}}
                    {{-- <li class="list-unstyled m-0" style="background-color: rgb(194, 137, 64);">--}}

                    {{-- </li>--}}
                    {{-- </ul>--}}
                    {{-- </div>--}}
                    @if ($product['final_price'] != 0)
                        <div class="price mt-2 align-items-sm-center">
                            @if ($product['final_price'] != 0 || $product['price'])
                                @if($product['final_price'] != 0)
                                    <p class="m-0 font-num-r fw-bolder">{{number_format($product['final_price'])}}
                                        تومان</p>
                                @endif
                                @if($product['discounted_price'])
                                    <div class="old-price">
                                        <p class="m-0 font-num-r">{{number_format($product['price'])}} تومان </p>
                                    </div>
                                @endif
                            @endif
                        </div>
                    @else
                        <div class="price mt-2 align-items-sm-center">
                            <p class="m-0 font-num-r fw-bolder">تماس بگیرید</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</a>
