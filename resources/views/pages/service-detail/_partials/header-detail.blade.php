<section class="hero position-relative">
    <div id="carouselExample" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{$service['header_image']}}" class="w-100" alt="hero" title="hero">
            </div>
        </div>
    </div>
    <div
        class="over-hero position-absolute top-0 bottom-0 end-0 start-0 d-flex align-items-sm-end align-items-end justify-content-start ">
        <div class="hero-content container">
            <div class="row w-100 m-0">
                <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 p-0 pe-lg-4">
                    <h1 class="mb-sm-1 mb-1 fw-bold light">
                        {{$service['title']}}
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index')}}"
                                                           class="d-flex font-re align-items-center text-light"><i
                                        class="bi bi-house d-flex me-1"></i>خانه</a></li>
                            <li class="breadcrumb-item">
                                <a
                                    href="{{ route('service.list') }}"
                                    class="text-light font-re">خدمات</a>
                            </li>
                            @if(isset($service->parent_id))
                                <li class="breadcrumb-item"><a
                                        href="{{ route('service.detail', ['url' => $service->parent->url]) }}"
                                        class="text-light font-re"> {{$service->parent->title}}</a></li>
                            @endif
                            <li class="breadcrumb-item active text-light" aria-current="page">{{$service['title']}}</li>
                        </ol>
                    </nav>
                    <p class="font-th light mb-4 ">
                        {!! $service['short_description'] !!}
                    </p>
                    <div class="anchors d-flex align-items-center">
                        <a href="tel:{{$service['phone_number'] ? $service['phone_number'] : @$settings['main_phone_number']}}"
                           class="btn-one d-block font-re me-3 d-flex align-items-center dynamic-color">
                           <i class="bi bi-telephone-fill d-flex fs-5 me-2 "></i>
                            تماس با کارشناسان {{$service['title']}}
                        </a>
                        @if(count($samples))
                            <a href="#samples" class="btn-two d-block font-re">
                                مشاهده نمونه کار
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-10 m-auto align-self-center p-lg-1 p-0">
                    <div class="img-header-inner">
                        <img src="{{$service['image']}}" class="w-100" alt="{{$service['title']}}"
                             title="{{$service['title']}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.common.banner-scrollable-animation')
