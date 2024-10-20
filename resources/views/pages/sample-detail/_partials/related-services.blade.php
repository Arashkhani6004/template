@if(count($related_samples) > 0)
<section class="related-services">
    <div class="container">
        <div
            class="title-section position-relative mb-sm-5 mb-4 text-center col-xxl-5 col-xl-6 col-lg-7 col-md-12 m-auto p-0">
            <p class="fw-bolder h2 mb-4 title"> نمونه کار های مرتبط</p>
        </div>
    </div>
    <div class="swiper swiper-team">
        <div class="swiper-wrapper justify-content-md-center py-3">
            @foreach($related_samples as $related_sample)
            <div class="swiper-slide">
                <div class="list-card position-relative">

                <img src="{{$related_sample->getImage()}}" class="w-100" alt="{{$related_sample['title']}}"
                        title="{{$related_sample['title']}}" loading="lazy">

                    <div class="overlay">
                        <p class="font-md mb-0">
                        {{$related_sample['title']}}
                        </p>
                        @if ($related_sample['url'] != null)
                        <a href="{{ route('portfolio.detail', ['url' => $related_sample['url']]) }}" class="btn btn-two w-100 btn-sm py-2 px-3 mt-1">
                            مشاهده جزئیات
                        </a>
                        @endif
                    </div>

                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
@endif
