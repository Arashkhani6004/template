@if(count($blogs) > 0)
    <section class="related-blog pb-5">
        <div class="container">
            <div
                class="title-section position-relative mb-sm-5 mb-4 text-center col-xxl-5 col-xl-6 col-lg-7 col-md-12 m-auto p-0">
                <p class="fw-bolder h2 mb-4 title">مطالب مرتبط</p>
            </div>
            <div class="swiper swiper-package">
                <div class="swiper-wrapper ">
                    @foreach($blogs as $blog)
                        <div class="swiper-slide">
                            <div class="package-card">
                                <a href="{{ route('blog.detail', ['url' => $blog['url']]) }}"
                                   class="color-title text-start h-rotate">
                                    <div class="d-flex justify-content-end pb-4">
                                <span class="arrow">
                                    <img src="{{asset('assets/site/images/left-top-arrow.svg')}}" class="main-icon"
                                         alt="package-icon" title="package-icon">
                                </span>
                                    </div>
                                    <div class="package-title pb-3">
                                        <p class="font-re m-0">
                                            {{$blog['title']}}
                                        </p>
                                    </div>
                                    <img src="{{$blog['item_image']}}" class="w-100 main-image"
                                         alt="{{$blog['title']}}" title="{{$blog['title']}}">
                                    <ul class="p-0 m-0 pt-4">
                                        <li class="d-flex align-items-center pb-2 font-th">
                                            <i class="bi bi-bookmarks d-flex me-2"></i>
                                            {{jdate('l j F Y',strtotime($blog['created_at']))}}
                                        </li>
                                    </ul>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
