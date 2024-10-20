@if(count($samples) > 0)
    <div class="samples mt-5">
        <div id="samples"></div>
        <div class="container">
            <div
                class="title-section position-relative mb-sm-5 mb-4 text-center col-xxl-5 col-xl-6 col-lg-7 col-md-12 m-auto p-0">
                <p class="fw-bolder h2 mb-4 title">نمونه کارهای {{$service['title']}}</p>
            </div>
            <!-- samples desktop -->
            <div class="row w-100 m-0">
                @foreach($samples as $sample)
                    <div class="col-xl-4 col-md-6 col-sm-6 col-6 p-xl-1 p-md-1 p-1">
                        @if($sample['double_image'] == 1)
                            <section class="image-comparison" data-component="image-comparison-slider">
                                <div class="image-comparison__slider-wrapper">
                                    <label for="image-comparison-range" class="image-comparison__label"></label>
                                    <input type="range" min="0" max="100" value="50" class="image-comparison__range"
                                           id="image-compare-range" data-image-comparison-range="">

                                    <div
                                        class="image-comparison__image-wrapper  image-comparison__image-wrapper--overlay"
                                        data-image-comparison-overlay="">
                                        <figure class="image-comparison__figure image-comparison__figure--overlay">
                                            <picture class="image-comparison__picture">
                                                <source media="(max-width: 40em)"
                                                        srcset="{{$sample->getBeforeImage()}}">
                                                <source media="(min-width: 40.0625em) and (max-width: 48em)"
                                                        srcset="{{$sample->getBeforeImage()}}">
                                                <img src="{{$sample->getBeforeImage()}}" alt="{{$sample['title']}}"
                                                     title="{{$sample['title']}}" class="image-comparison__image">
                                            </picture>

                                            <figcaption
                                                class="image-comparison__caption image-comparison__caption--before">
                                                <span class="image-comparison__caption-body">قبل</span>
                                            </figcaption>
                                        </figure>
                                    </div>

                                    <div class="image-comparison__slider" data-image-comparison-slider="">
                            <span class="image-comparison__thumb" data-image-comparison-thumb="">
                                <svg class="image-comparison__thumb-icon" xmlns="http://www.w3.org/2000/svg" width="18"
                                     height="10" viewBox="0 0 18 10" fill="currentColor">
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
                                                <source media="(max-width: 40em)" srcset="{{$sample->getImage()}}">
                                                <source media="(min-width: 40.0625em) and (max-width: 48em)"
                                                        srcset="{{$sample->getImage()}}">
                                                <img src="{{$sample->getImage()}}" alt="{{$sample['title']}}"
                                                     title="{{$sample['title']}}" class="image-comparison__image">
                                            </picture>

                                            <figcaption
                                                class="image-comparison__caption image-comparison__caption--after">
                                                <span class="image-comparison__caption-body">بعد</span>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </div>
                            </section>
                            <div class="d-flex align-items-center justify-content-center name-sample">
                                <p class="m-0 font-md"> {{$sample['title']}}</p>
                                @if ($sample['url'] != null)
                                    <a href="{{ route('portfolio.detail', ['url' => $sample['url']]) }}"
                                       class="d-flex align-items-center justify-content-between font-th font-small color-title ms-auto">
                                        مشاهده
                                        <i class="bi bi-chevron-left d-flex ms-1"></i>
                                    </a>
                                @endif
                            </div>
                        @endif
                        @if($sample['double_image'] == 0 && count($sample['images']) == 1)
                            <div class="single-sample">
                                <img src="{{$sample->getImage()}}" class="w-100" alt="{{$sample['title']}}"
                                     title="{{$sample['title']}}" loading="lazy"/>
                            </div>
                            <div class="d-flex align-items-center justify-content-center name-sample">
                                <p class="m-0 font-md"> {{$sample['title']}}</p>
                                @if ($sample['url'] != null)
                                    <a href="{{ route('portfolio.detail', ['url' => $sample['url']]) }}"
                                       class="d-flex align-items-center justify-content-between font-th font-small color-title ms-auto">
                                        مشاهده
                                        <i class="bi bi-chevron-left d-flex ms-1"></i>
                                    </a>
                                @endif
                            </div>
                        @endif
                        @if($sample['double_image'] == 0 && count($sample['images']) > 1)
                            <div class="single-sample">
                                @if ($sample['url'] != null)
                                    <a href="{{ route('portfolio.detail', ['url' => $sample['url']]) }}">
                                        <img src="{{$sample->getImage()}}" class="w-100" alt="{{$sample['title']}}"
                                             title="{{$sample['title']}}" loading="lazy"/>
                                    </a>
                                @else
                                    <img src="{{$sample->getImage()}}" class="w-100" alt="{{$sample['title']}}"
                                         title="{{$sample['title']}}" loading="lazy"/>
                                @endif
                            </div>
                            <div class="d-flex align-items-center justify-content-between name-sample">
                                <p class="m-0 font-md"> {{$sample['title']}}</p>
                                @if ($sample['url'] != null)
                                    <a href="{{ route('portfolio.detail', ['url' => $sample['url']]) }}"
                                       class="d-flex align-items-center justify-content-between font-th font-small color-title d-flex align-items-center">
                                        مشاهده
                                        <i class="bi bi-chevron-left d-flex ms-1"></i>
                                    </a>
                                @else
                                    <button
                                        class="btn p-0 bg-transparent border-0 shadow-none d-flex align-items-center justify-content-between font-th font-small color-title d-flex align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal{{$sample['id']}}">
                                        مشاهده
                                        <i class="bi bi-chevron-left d-flex ms-1"></i>
                                    </button>

                                    {{--samples modal--}}
                                    <div class="modal fade" id="exampleModal{{$sample['id']}}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content bg-transparent border-0">
                                                <div class="modal-header border-0 p-0">
                                                    <button type="button"
                                                            class="btn ms-auto bg-transparent border-0 p-2 shadow-none text-white"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="bi bi-x-lg d-flex fs-4"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body p-0">
                                                    <div class="swiper mySwiper-sample p-1">
                                                        <div class="swiper-wrapper">
                                                            @foreach($sample['images'] as $sample_image)
                                                                <div class="swiper-slide">
                                                                    <img src="{{$sample_image['image']}}"
                                                                         alt="{{$sample['title']}}"
                                                                         title="{{$sample['title']}}"/>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="swiper-button-next"></div>
                                                        <div class="swiper-button-prev"></div>
                                                    </div>
                                                    <div thumbsSlider="" class="swiper mySwiper-thumb-sample p-1">
                                                        <div class="swiper-wrapper py-2">
                                                            @foreach($sample['images'] as $sample_image)
                                                                <div class="swiper-slide">
                                                                    <img src="{{$sample_image['image_small']}}"
                                                                         alt="{{$sample['title']}}"
                                                                         title="{{$sample['title']}}"/>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
