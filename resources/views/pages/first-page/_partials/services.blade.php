@if(count($services) > 0)
    <section class="services pb-5">
        <div class="container">
            <div class="title-section mb-4 text-center col-xxl-6 col-xl-6 col-lg-7 col-md-8 m-auto p-0">
                <p class="fw-bolder h2 mb-4 title">{!! @$settings['first_page_service_title'] !!}</p>
                <p class="font-th op-lighter short-des">
                    {!! @$settings['first_page_service_text'] !!}
                </p>
            </div>
            <div thumbsSlider="" dir="rtl" class="swiper mySwiper mb-sm-5 mb-4 pb-md-5 pb-3 px-sm-2">
                <div class="swiper-wrapper justify-content-md-center">
                    {{--Todo ui : ترتیبش باید از راست به چپ باشه ولی چپ به راسته : Done--}}
                    @foreach($services as  $service)
                        <div class="swiper-slide">
                            <div class="tab-button font-th small dynamic-color">
                                {{$service['title']}}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <div dir="rtl" class="swiper mySwiper2">
                <div class="swiper-wrapper">
                    @foreach($services as $service)
                        <div class="swiper-slide">
                            <img src="{{$service['image']}}" class="w-100" alt="{{$service['title']}}"
                                 title="{{$service['title']}}" loading="lazy">
                            <a href="{{ route('service.detail', ['url' => $service['url']]) }}" class="btn-arrow h-rotate">
                                مشاهده
                                <span class="arrow-box">
                                    <i class="bi bi-arrow-up-left d-flex fs-5 main-icon dynamic-color"></i>
                                </span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
