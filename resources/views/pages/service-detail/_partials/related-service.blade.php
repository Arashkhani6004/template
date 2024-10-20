@if(count($related_services) > 0)
    <section class="related-services">
        <div class="container">
            <div
                class="title-section position-relative mb-sm-5 mb-4 text-center col-xxl-5 col-xl-6 col-lg-7 col-md-12 m-auto p-0">
                <p class="fw-bolder h2 mb-4 title"> خدمات مرتبط</p>
            </div>
        </div>
        <div class="swiper swiper-team">
            <div class="swiper-wrapper py-3">
                @foreach($related_services as $related)
                    <div class="swiper-slide">
                        <a href="{{ route('service.detail', ['url' => $related['url']]) }}">
                            <div class="team-card">
                                <img src="{{$related['image']}}" class="team-img" alt="{{$related['title']}}"
                                     title="{{$related['title']}}" loading="lazy">
                                <p class="name text-center color-title font-re mt-3 mb-2">
                                    {{$related['title']}}
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
