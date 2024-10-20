<section class="hero position-relative">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{@$sample->getImage()}}" class="w-100" alt="{{$sample['title']}}" title="{{$sample['title']}}">
        </div>
    </div>
    <div
        class="over-hero position-absolute top-0 bottom-0 end-0 start-0 d-flex align-items-sm-end align-items-end justify-content-start ">
        <div class="hero-content container">
            <div class="row w-100 m-0">
                <div
                    class="col-xxl-8 col-xl-8 col-lg-7 col-md-7 col-sm-12 col-12 p-0 pe-lg-4 pe-md-3 align-self-center mb-md-0 mb-4">
                    <h1 class="mb-sm-1 mb-1 fw-bold light">
                        {{$sample['title']}}
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index')}}"
                                    class="d-flex font-re align-items-center text-light"><i
                                        class="bi bi-house d-flex me-1"></i>خانه</a></li>
                            <li class="breadcrumb-item"><a href="{{route('portfolio.list')}}"
                                    class="text-light font-re">نمونه کارها</a></li>
                            <li class="breadcrumb-item active text-light" aria-current="page">{{$sample['title']}}</li>
                        </ol>
                    </nav>
                    <p class="font-th light mb-4 ">
                        {{$sample['short_description']}}
                    </p>
                    <div class="anchors d-flex align-items-lg-center flex-lg-row flex-md-column ">
                        <a href="tel:{{$settings['main_phone_number']}}"
                            class="btn-one d-block font-re me-lg-3 me-md-0 me-3 d-flex align-items-center mb-lg-0 mb-md-3 dynamic-color">
                            <i class="bi bi-telephone-fill d-flex fs-5 me-2 "></i>
                            تماس با کارشناسان
                        </a>
                        {{--                        <a href="#" class="btn-two d-block font-re">--}}
                        {{--                            خدمات عروس--}}
                        {{--                        </a>--}}
                    </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-5 col-md-5 col-sm-8  m-auto align-self-center p-lg-1 p-0">
                    @if($sample['double_image'] == 1)
                    <div class="swiper mySwiper-sample p-1">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <section class="image-comparison w-100 detail-sample"
                                    data-component="image-comparison-slider">
                                    <div class="image-comparison__slider-wrapper">
                                        <label for="image-comparison-range" class="image-comparison__label"></label>
                                        <input type="range" min="0" max="100" value="50" class="image-comparison__range"
                                            id="image-compare-range" data-image-comparison-range="">

                                        <div class="image-comparison__image-wrapper  image-comparison__image-wrapper--overlay"
                                            data-image-comparison-overlay="">
                                            <figure class="image-comparison__figure image-comparison__figure--overlay">
                                                <picture class="image-comparison__picture">
                                                    <source media="(max-width: 40em)"
                                                        srcset="{{@$sample->getBeforeImage()}}">
                                                    <source media="(min-width: 40.0625em) and (max-width: 48em)"
                                                        srcset="{{@$sample->getBeforeImage()}}">
                                                    <img src="{{@$sample->getBeforeImage()}}"
                                                        alt="{{$sample['title']}}" class="image-comparison__image">
                                                </picture>
                                                <figcaption
                                                    class="image-comparison__caption image-comparison__caption--before">
                                                    <span class="image-comparison__caption-body">قبل</span>
                                                </figcaption>
                                            </figure>
                                        </div>

                                        <div class="image-comparison__slider" data-image-comparison-slider="">
                                            <span class="image-comparison__thumb" data-image-comparison-thumb="">
                                                <svg class="image-comparison__thumb-icon"
                                                    xmlns="http://www.w3.org/2000/svg" width="18" height="10"
                                                    viewBox="0 0 18 10" fill="currentColor">
                                                    <path class="image-comparison__thumb-icon--left"
                                                        d="M12.121 4.703V.488c0-.302.384-.454.609-.24l4.42 4.214a.33.33 0 0 1 0 .481l-4.42 4.214c-.225.215-.609.063-.609-.24V4.703z">
                                                    </path>
                                                    <path class="image-comparison__thumb-icon--right"
                                                        d="M5.879 4.703V.488c0-.302-.384-.454-.609-.24L.85 4.462a.33.33 0 0 0 0 .481l4.42 4.214c.225.215.609.063.609-.24V4.703z">
                                                    </path>
                                                </svg>
                                            </span>
                                        </div>

                                        <div class="image-comparison__image-wrapper">
                                            <figure class="image-comparison__figure">
                                                <picture class="image-comparison__picture">
                                                    <source media="(max-width: 40em)"
                                                        srcset="{{@$sample->getImage()}}">
                                                    <source media="(min-width: 40.0625em) and (max-width: 48em)"
                                                        srcset="{{@$sample->getImage()}}">
                                                    <img src="{{@$sample->getImage()}}"
                                                        alt="{{$sample['title']}}" class="image-comparison__image">
                                                </picture>

                                                <figcaption
                                                    class="image-comparison__caption image-comparison__caption--after">
                                                    <span class="image-comparison__caption-body">بعد</span>
                                                </figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <div thumbsSlider="" class="swiper mySwiper-thumb-sample p-1">
                        <div class="swiper-wrapper py-2">
                            <div class="swiper-slide">
                                <img src="{{@$sample->getImage()}}" alt="{{$sample['title']}}"
                                    title="{{$sample['title']}}" />
                            </div>
                        </div>
                    </div>

                    @endif
                    @if($sample['double_image'] == 0 && count($sample['images']) == 1)
                    <div class="swiper mySwiper-sample p-1">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{@$sample->getImage()}}" alt="{{$sample['title']}}"
                                    title="{{$sample['title']}}" />
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <div thumbsSlider="" class="swiper mySwiper-thumb-sample p-1">
                        <div class="swiper-wrapper py-2">
                            <div class="swiper-slide">
                                <img src="{{@$sample->getImage()}}" alt="{{$sample['title']}}"
                                    title="{{$sample['title']}}" />
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($sample['double_image'] == 0 && count($sample['images']) > 1)
                    <div class="swiper mySwiper-sample p-1">
                        <div class="swiper-wrapper">
                            @foreach($sample->imagesCollection as $sample_image)
                            <div class="swiper-slide">
                                <img src="{{@$sample_image->getImage()}}" alt="{{$sample['title']}}"
                                    title="{{$sample['title']}}" />
                            </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <div thumbsSlider="" class="swiper mySwiper-thumb-sample p-1">
                        <div class="swiper-wrapper py-2">
                            @foreach($sample->imagesCollection as $sample_image)
                            <div class="swiper-slide">
                                <img src="{{@$sample_image->getImage()}}" alt="{{$sample['title']}}"
                                    title="{{$sample['title']}}" />
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    {{--                    <div class="swiper mySwiper-sample">--}}
                    {{--                        <div class="swiper-wrapper">--}}
                    {{--                            <div class="swiper-slide">--}}
                    {{--                                <section class="image-comparison w-100 detail-sample"--}}
                    {{--                                    data-component="image-comparison-slider">--}}
                    {{--                                    <div class="image-comparison__slider-wrapper">--}}
                    {{--                                        <label for="image-comparison-range" class="image-comparison__label"></label>--}}
                    {{--                                        <input type="range" min="0" max="100" value="50" class="image-comparison__range"--}}
                    {{--                                            id="image-compare-range" data-image-comparison-range="">--}}

                    {{--                                        <div class="image-comparison__image-wrapper  image-comparison__image-wrapper--overlay"--}}
                    {{--                                            data-image-comparison-overlay="">--}}
                    {{--                                            <figure class="image-comparison__figure image-comparison__figure--overlay">--}}
                    {{--                                                <picture class="image-comparison__picture">--}}
                    {{--                                                    <source media="(max-width: 40em)"--}}
                    {{--                                                        srcset="{{asset('assets/site/images/before-eye.jpg')}}">--}}
                    {{--                                                    <source media="(min-width: 40.0625em) and (max-width: 48em)"--}}
                    {{--                                                        srcset="{{asset('assets/site/images/before-eye.jpg')}}">--}}
                    {{--                                                    <img src="{{asset('assets/site/images/before-eye.jpg')}}"--}}
                    {{--                                                        alt="Mojave desert in the sun" class="image-comparison__image">--}}
                    {{--                                                </picture>--}}

                    {{--                                                <figcaption--}}
                    {{--                                                    class="image-comparison__caption image-comparison__caption--before">--}}
                    {{--                                                    <span class="image-comparison__caption-body">قبل</span>--}}
                    {{--                                                </figcaption>--}}
                    {{--                                            </figure>--}}
                    {{--                                        </div>--}}

                    {{--                                        <div class="image-comparison__slider" data-image-comparison-slider="">--}}
                    {{--                                            <span class="image-comparison__thumb" data-image-comparison-thumb="">--}}
                    {{--                                                <svg class="image-comparison__thumb-icon"--}}
                    {{--                                                    xmlns="http://www.w3.org/2000/svg" width="18" height="10"--}}
                    {{--                                                    viewBox="0 0 18 10" fill="currentColor">--}}
                    {{--                                                    <path class="image-comparison__thumb-icon--left"--}}
                    {{--                                                        d="M12.121 4.703V.488c0-.302.384-.454.609-.24l4.42 4.214a.33.33 0 0 1 0 .481l-4.42 4.214c-.225.215-.609.063-.609-.24V4.703z">--}}
                    {{--                                                    </path>--}}
                    {{--                                                    <path class="image-comparison__thumb-icon--right"--}}
                    {{--                                                        d="M5.879 4.703V.488c0-.302-.384-.454-.609-.24L.85 4.462a.33.33 0 0 0 0 .481l4.42 4.214c.225.215.609.063.609-.24V4.703z">--}}
                    {{--                                                    </path>--}}
                    {{--                                                </svg>--}}
                    {{--                                            </span>--}}
                    {{--                                        </div>--}}

                    {{--                                        <div class="image-comparison__image-wrapper">--}}
                    {{--                                            <figure class="image-comparison__figure">--}}
                    {{--                                                <picture class="image-comparison__picture">--}}
                    {{--                                                    <source media="(max-width: 40em)"--}}
                    {{--                                                        srcset="{{asset('assets/site/images/after-eye.jpg')}}">--}}
                    {{--                                                    <source media="(min-width: 40.0625em) and (max-width: 48em)"--}}
                    {{--                                                        srcset="{{asset('assets/site/images/after-eye.jpg')}}">--}}
                    {{--                                                    <img src="{{asset('assets/site/images/after-eye.jpg')}}"--}}
                    {{--                                                        alt="Mojave desert in the dark" class="image-comparison__image">--}}
                    {{--                                                </picture>--}}

                    {{--                                                <figcaption--}}
                    {{--                                                    class="image-comparison__caption image-comparison__caption--after">--}}
                    {{--                                                    <span class="image-comparison__caption-body">بعد</span>--}}
                    {{--                                                </figcaption>--}}
                    {{--                                            </figure>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </section>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="swiper-slide">--}}
                    {{--                                <img src="{{asset('assets/site/images/smaple1.webp')}}" />--}}
                    {{--                            </div>--}}
                    {{--                            <div class="swiper-slide">--}}
                    {{--                                <img src="{{asset('assets/site/images/sample2.webp')}}" />--}}
                    {{--                            </div>--}}
                    {{--                            <div class="swiper-slide">--}}
                    {{--                                <img src="{{asset('assets/site/images/sample3.webp')}}" />--}}
                    {{--                            </div>--}}
                    {{--                            <div class="swiper-slide">--}}
                    {{--                                <img src="{{asset('assets/site/images/sample4.webp')}}" />--}}
                    {{--                            </div>--}}
                    {{--                            <div class="swiper-slide">--}}
                    {{--                                <img src="{{asset('assets/site/images/sample2.webp')}}" />--}}
                    {{--                            </div>--}}
                    {{--                            <div class="swiper-slide">--}}
                    {{--                                <img src="{{asset('assets/site/images/sample3.webp')}}" />--}}
                    {{--                            </div>--}}
                    {{--                            <div class="swiper-slide">--}}
                    {{--                                <img src="{{asset('assets/site/images/smaple1.webpg')}}" />--}}
                    {{--                            </div>--}}
                    {{--                            <div class="swiper-slide">--}}
                    {{--                                <img src="{{asset('assets/site/images/sample4.webp')}}" />--}}
                    {{--                            </div>--}}
                    {{--                            <div class="swiper-slide">--}}
                    {{--                                <video width="100%" controls poster="{{asset('assets/site/images/sample3.webp')}}">--}}
                    {{--                                    <source src="{{asset('assets/site/images/video2.mov')}}"
                    type="video/mp4">--}}
                    {{--                                </video>--}}

                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="swiper-button-next"></div>--}}
                    {{--                        <div class="swiper-button-prev"></div>--}}
                    {{--                    </div>--}}
                    {{--                    <div thumbsSlider="" class="swiper mySwiper-thumb-sample mt-3">--}}
                    {{--                        <div class="swiper-wrapper">--}}
                    {{--                            <div class="swiper-slide">--}}
                    {{--                                <img src="{{asset('assets/site/images/afrer-lip.jpg')}}" />--}}
                    {{--                            </div>--}}
                    {{--                            <div class="swiper-slide">--}}
                    {{--                                <img src="{{asset('assets/site/images/smaple1.webp')}}" />--}}
                    {{--                            </div>--}}
                    {{--                            <div class="swiper-slide">--}}
                    {{--                                <img src="{{asset('assets/site/images/sample2.webp')}}" />--}}
                    {{--                            </div>--}}
                    {{--                            <div class="swiper-slide">--}}
                    {{--                                <img src="{{asset('assets/site/images/sample3.webp')}}" />--}}
                    {{--                            </div>--}}
                    {{--                            <div class="swiper-slide">--}}
                    {{--                                <img src="{{asset('assets/site/images/sample4.webp')}}" />--}}
                    {{--                            </div>--}}
                    {{--                            <div class="swiper-slide">--}}
                    {{--                                <img src="{{asset('assets/site/images/sample2.webp')}}" />--}}
                    {{--                            </div>--}}
                    {{--                            <div class="swiper-slide">--}}
                    {{--                                <img src="{{asset('assets/site/images/sample3.webp')}}" />--}}
                    {{--                            </div>--}}
                    {{--                            <div class="swiper-slide">--}}
                    {{--                                <img src="{{asset('assets/site/images/smaple1.webp')}}" />--}}
                    {{--                            </div>--}}
                    {{--                            <div class="swiper-slide">--}}
                    {{--                                <img src="{{asset('assets/site/images/sample4.webp')}}" />--}}
                    {{--                            </div>--}}
                    {{--                            <div class="swiper-slide">--}}
                    {{--                                <div class="cover-video">--}}
                    {{--                                    <img src="{{asset('assets/site/images/sample4.webp')}}"
                    />--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</section>
