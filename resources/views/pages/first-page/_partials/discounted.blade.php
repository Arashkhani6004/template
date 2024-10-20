@if(count($timer_products) > 0)
    <section class="offer">
        <div class="container">
            <div class="offer-sale" style="background-image: url('{{@$settings['timer_image']}}');">
                <div class="row w-100 m-0 inner">
                    <div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 col-sm-4 col-4 pe-lg-4 pe-2 pe-0 ps-0">
                        <div class="off-image">
                            <p class="m-0 offer-title font-bold">
                                پیشنهاد شگفت انگیز
                            </p>
                            <img src="{{asset('assets/site/images/Off-Banner.png')}}" alt="banner" title="banner"
                                 loading="lazy">
                            <a href="{{route('product.get-discounted-list')}}"
                               class="d-flex align-items-center offer-anchor color-title justify-content-center font-bold">
                                همه محصولات
                                <i class="bi bi-chevron-left d-flex ms-1"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9 col-sm-8 col-8 ps-lg-4 ps-2 ps-0 pe-0">
                        <div class="swiper swiper-offer">
                            <div class="swiper-wrapper ">
                                @foreach($timer_products as $timer)
                                    <div class="swiper-slide bg-transparent">
                                        <div class="offer-card">
                                            <a href="{{ route('product.detail', ['url' => $timer['url']]) }}"
                                               class="color-title">
                                                <div class="product-card">
                                                    @if($timer->percent)
                                                        <div class="off font-num-r">
                                                            {{$timer->percent}}%
                                                        </div>
                                                    @endif
                                                    <img src="{{$timer->getImage('medium')}}" class="w-100"
                                                         alt="{{$timer['title']}}" title="{{$timer['title']}}"
                                                         loading="lazy">
                                                    <div class="name mt-2">
                                                        <p class="font-bold m-0">{{$timer['title']}}</p>
                                                    </div>
                                                    @if ($timer['final_price'] != 0 || $timer['price'])
                                                        <div class="price mt-2">
                                                            @if($timer['final_price'] != 0)
                                                                <p class="m-0 font-num-r fw-bolder">{{number_format($timer['final_price'])}}
                                                                    تومان</p>
                                                            @endif
                                                            @if($timer['price'])
                                                                <div class="old-price">
                                                                    <p class="m-0 font-num-r">{{number_format($timer['price'])}} تومان </p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                    <ul class="p-0 m-0 d-flex align-items-center countdown justify-content-center gap-2 mt-2">
                                                        <li><span id="seconds{{$timer['id']}}"></span></li>
                                                        :
                                                        <li><span id="minutes{{$timer['id']}}"></span></li>
                                                        :
                                                        <li><span id="hours{{$timer['id']}}"></span></li>
                                                        <li><span id="days{{$timer['id']}}" class="me-1"></span>روز</li>
                                                    </ul>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('pages.first-page._partials.timer-script')
@endif
