@if(count($product_categories) > 0)
    <section class="product-category">
        @if(count($settings['first_page_category_text']) > 0 && strlen(@$settings['first_page_category_text'][0]) > 0)
            <div class="banner-scrollable overflow-hidden d-flex flex-nowrap">
                <div class="scroll-text">
                    <ul class="m-0 p-0 d-flex align-items-center justify-content-center" dir="ltr">
                        @foreach($settings['first_page_category_text'] as $category_text)
                            <li class=" dynamic-color"> {{$category_text}} </li>
                        @endforeach
                    </ul>
                </div>
                <div class="scroll-text">
                    <ul class="m-0 p-0 d-flex align-items-center justify-content-center" dir="ltr">
                        @foreach($settings['first_page_category_text'] as $category_text)
                            <li class=" dynamic-color"> {{$category_text}} </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="container">
            <div class="categories">
                <div class="row w-100 m-0">
                    <div class="col-xl-3 ps-0 pe-xxl-4 pe-xl-2 pe-0 mb-xl-0 mb-4 align-self-center">
                        <div class="cat-text">
                            <p class="font-bold m-0">
                                دسته بندی
                            </p>
                            <p class="font-bold m-0">
                                محصولات فروشگاه
                            </p>
                        </div>
                        <div class="all-cat mt-3">
                            <a href="{{route('category.list')}}"
                               class="btn btn-arrow-two d-flex align-items-center justify-content-between py-3 h-rotate dynamic-color">
                                مشاهده محصولات
                                <span class="arrow-box m-0">
                                <i class="bi bi-arrow-up-left d-flex fs-5 main-icon text-dark"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-9 pe-0 ps-xxl-4 ps-xl-2 ps-0 align-self-center">
                        <div class="swiper swiper-categories">
                            <div class="swiper-wrapper ">
                                @foreach($product_categories as $product_category)
                                    <div class="swiper-slide">
                                        <div class="cat-card">
                                            <a href="{{ route('category.detail', ['url' => $product_category['url']]) }}"
                                               class="h-rotate color-title">
                                                <p class="font-md mb-2 dynamic-color name">
                                                    {{@$product_category['title']}}
                                                </p>
                                                {{--                                        <p class="font-num-r mb-3">--}}
                                                {{--                                            ۳۲ محصول--}}
                                                {{--                                        </p>--}}
                                                <div class="img-cat">
                                                    <img src="{{@$product_category->getImage("big")}}"
                                                         alt="{{@$product_category['title']}}"
                                                         title="{{@$product_category['title']}}" loading="lazy">
                                                </div>
                                                <span class="arrow-box m-0">
                                                <i class="bi bi-arrow-up-left d-flex main-icon dynamic-color fs-5"></i>

                                        </span>
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
