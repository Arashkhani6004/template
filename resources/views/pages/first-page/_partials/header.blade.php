<section class="hero position-relative">
    <div id="carouselFirstPage" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($banners as $banner)
                <div class="carousel-item @if($loop->first) active @endif">
                    @mobile
                        {{-- carousel mobile --}}
                        <img src="{{$banner['image_mobile']}}" class="w-100 d-lg-none d-block" alt="{{$banner['title']}}"
                             title="{{$banner['title']}}">
                    @else
                        {{-- carousel desktop --}}
                        <img src="{{$banner['image']}}" class="w-100 d-lg-block d-none" alt="{{$banner['title']}}"
                             title="{{$banner['title']}}">
                    @endmobile
                </div>
            @endforeach
        </div>
        @if(count($banners) > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselFirstPage"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselFirstPage"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        @endif
    </div>
    <div class="over-hero position-absolute top-0 bottom-0 end-0 start-0 d-flex align-items-end justify-content-start">
        <div class="hero-content container">
            <div class="col-xxl-7 col-xl-8 col-lg-9 col-md-12 col-sm-12 col-12 p-0">
                @if(isset($settings['slider_title']) && $settings['slider_title'])
                    <h1 class="mb-4 fw-bold light">
                        {{$settings['slider_title']}}
                    </h1>
                @endif
                @if(isset($settings['slider_description']) && @$settings['slider_description'])
                    <p class="font-th light mb-4 ">
                        {!! $settings['slider_description'] !!}
                    </p>
                @endif
                <div class="anchors d-flex align-items-center">
                    {{--Todo : choose a better settings key name--}}
                    {{--Todo : make a blade directive for this if structure--}}
                    @if(isset($settings['first_link']) && $settings['first_link'])
                        <a href="{{$settings['first_link']}}"
                           class="btn-one d-block font-re me-3 dynamic-color">{{$settings['first_button']}}</a>
                    @endif
                    @if(isset($settings['second_link']) && $settings['second_link'])
                        <a href="{{$settings['second_link']}}"
                           class="btn-two d-block font-re">{{$settings['second_button']}}</a>
                    @endif
                </div>
            </div>

            <div class="col-xxl-5 col-xl-6 col-lg-7 col-12 mt-xl-0 mt-4 ms-auto">
                <div class="video position-relative">
                    @if(isset($settings['video_cover']) && $settings['video_cover'])
                        <img
                            src="{{$settings['video_cover']}}"
                            alt="cover-video" title="cover-video" class="w-100 d-sm-block d-none">
                    @endif
                    @if(isset($settings['video_link']) && $settings['video_link'])
                        <button type="button" class="btn border-0 btn-video d-flex align-items-center font-th small"
                                data-bs-toggle="modal" data-bs-target="#videoModal">
                            <span class="play me-3 d-flex align-items-center justify-content-center">
                                <img src="{{asset('assets/site/images/play-icon.svg')}}" width="15" height="15"
                                     alt="پلی ویدیو"
                                     title="پلی ویدیو">
                            </span>
                            با ما بیشتر آشنا شوید
                        </button>
                    @endif
                </div>
            </div>

        </div>
    </div>
    @if(isset($settings['video_link']) && $settings['video_link'])
        <div class="modal fade modal-video" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-transparent shadow-none border-0">
                    <div class="modal-header border-0">
                        <button type="button" class="shadow-none bg-transparent shadow-none border-0"
                                data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x-lg d-flex light fs-3"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! $settings['video_link'] !!}
                    </div>
                </div>
            </div>
        </div>
    @endif
</section>
@include('layouts.common.banner-scrollable-animation')
