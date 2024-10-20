@if(count($tags) > 0)
    @foreach($tags as $tag)
        @if(count($tag['products']) > 0)
            <section class="offer">
                <div class="container">
                    <div class="offer-sale" style="background-image: url('{{@$tag->item_first_page_image}}');">
                        <div class="row w-100 m-0 inner">
                            <div class="col-xxl-2 col-xl-3 col-lg-3 col-md-3 col-sm-4 col-4 pe-lg-4 pe-2 pe-0 ps-0">
                                <div class="off-image">
                                    <p class="m-0 offer-title font-bold">
                                        {{@$tag['title']}}
                                    </p>
                                    <img src="{{@$tag->item_first_page_icon}}" alt="{{@$tag['title']}}" title="{{@$tag['title']}}" loading="lazy">
                                    <a href="{{ route('tag.detail', ['url' => @$tag['url']]) }}" class="d-flex align-items-center offer-anchor color-title justify-content-center font-bold">
                                        مشاهده همه
                                        <i class="bi bi-chevron-left d-flex ms-1"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xxl-10 col-xl-9 col-lg-9 col-md-9 col-sm-8 col-8 ps-lg-4 ps-2 ps-0 pe-0">
                                <div class="swiper swiper-offer">
                                    <div class="swiper-wrapper ">
                                        @foreach($tag['products'] as $tag_product)
                                            <div class="swiper-slide bg-transparent">
                                                <div class="offer-card">
                                                    <a href="{{ route('product.detail', ['url' => $tag_product['url']]) }}" class="color-title">
                                                        <div class="product-card">
                                                            @if(@$tag_product->percent)
                                                                <div class="off font-num-r">
                                                                    {{$tag_product->percent}}%
                                                                </div>
                                                            @endif
                                                            <img src="{{$tag_product->getImage('medium')}}" class="w-100" alt="{{$tag_product['title']}}" title="{{$tag_product['title']}}" loading="lazy">
                                                            <div class="name mt-2">
                                                                <p class="font-bold m-0">{{$tag_product['title']}}</p>
                                                            </div>
                                                            @if ($tag_product['final_price'] != 0 || $tag_product['price'])
                                                                <div class="price mt-2">
                                                                    @if($tag_product['final_price'] != 0)
                                                                        <p class="m-0 font-num-r fw-bolder">{{number_format($tag_product['final_price'])}} تومان</p>
                                                                    @endif
                                                                    @if($tag_product['discounted_price'])
                                                                        <div class="old-price">
                                                                            <p class="m-0 font-num-r">{{number_format($tag_product['price'])}} تومان </p>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @else
                                                                <div class="price mt-2 align-items-sm-center">
                                                                    <p class="m-0 font-num-r fw-bolder">تماس بگیرید</p>
                                                                </div>
                                                            @endif
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
        @endif
    @endforeach


@endif
