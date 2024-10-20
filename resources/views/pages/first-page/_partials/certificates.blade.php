@if(count($certificates) > 0)
<section class="honors">
    <div class="container">
        <div class="honors-inn">
            <div class="title-section position-relative mb-sm-5 mb-4 text-center p-0">
                <p class="fw-bolder h2 mb-4 title">{!! @$settings['first_page_certificate_title'] !!} </p>
                <p class="font-re short-des">
                    {!! @$settings['first_page_certificate_text'] !!}
                </p>
            </div>
            {{-- desktop --}}
            <div class="swiper swiper-honors d-md-block d-none">
                <div class="swiper-wrapper justify-content-center py-5">
                    @foreach($certificates as $certificate)
                    <div class="swiper-slide">
                        <div class="honor-card">
                            {{-- Todo ui : modal not showing : Done--}}
                            <a href="#" class="h-100 d-block" data-bs-toggle="modal"
                                data-bs-target="#honorModal{{$certificate['id']}}">
                                <img src="{{$certificate->getImage()}}" alt="{{$certificate['title']}}"
                                    title="{{$certificate['title']}}" class="w-100 h-100 honor-img">
                                    <i class="bi bi-card-checklist d-flex show-icon fs-4 dynamic-color"></i>
                                <p class="font-re color-title m-0 show-title dynamic-color">{{$certificate['title']}}</p>
                                <div class="hidden">
                                    <button type="button"
                                        class="btn btn-honor font-re d-flex align-items-center justify-content-center dynamic-color">
                                        <i class="bi bi-eye-fill d-flex me-2"></i>
                                        مشاهده مدرک
                                    </button>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            {{-- mobile --}}
            <div class="swiper swiper-honors d-md-none d-block">
                <div class="swiper-wrapper py-5">
                    @foreach($certificates as $certificate)
                    <div class="swiper-slide">
                        <div class="honor-card-mobile text-center">
                            {{-- Todo ui : modal not showing : Done--}}
                            <a href="#" data-bs-toggle="modal" data-bs-target="#honorModal{{$certificate['id']}}"
                                class="h-100 d-block">
                                <div class="img-box position-relative">
                                    <img src="{{$certificate->getImage()}}" alt="{{$certificate['title']}}"
                                        title="{{$certificate['title']}}" class="w-100 h-100 honor-img">
                                    <div class="overlay">
                                        <img src="{{asset('assets/site/images/honors-icon.svg')}}" class="show-icon"
                                            alt="آیکن افتخارات" title="آیکن افتخارات" width="30" height="30">
                                        <p class="font-re color-title m-0 show-title">{{$certificate['title']}}</p>
                                    </div>
                                </div>
                                <button type="button"
                                    class="btn btn-honor m-auto mt-3 font-re d-flex align-items-center justify-content-center">
                                    <i class="bi bi-eye-fill d-flex me-2"></i>
                                    مشاهده مدرک
                                </button>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{--honorModal--}}
            @foreach($certificates as $certificate)
            <div class="modal fade" id="honorModal{{$certificate['id']}}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered ">
                    <div class="modal-content bg-transparent border-0">
                        <div class="modal-header bg-transparent border-0 border-bottom px-0">
                            <p class="modal-title text-white fs-5 font-md" id="exampleModalLabel">
                                {{$certificate['title']}}</p>
                            <button type="button" class="btn-close shadow-none btn-honor-modal" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-0">
                            <img src="{{$certificate->getImage()}}" alt="{{$certificate['title']}}"
                                title="{{$certificate['title']}}" class="w-100 honor-img">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
{{--//Todo ui : مودال گذاشته شود  : Done--}}
