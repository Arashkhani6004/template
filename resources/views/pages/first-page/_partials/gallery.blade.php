@if(count($galleries) > 0 || count($gallery_categories) > 0)
<section class="gallery">
    @foreach ($galleries as $index => $gallery)
        @if ($index < 3)
            <div class="gallery-item-img d-md-block d-none">
                <img src="{{$gallery['item_image']}}" alt="{{$gallery['title']}}" title="{{$gallery['title']}}" loading="lazy">
            </div>
        @endif
    @endforeach
    <div class="container">
        <div class="gallery-inner">
            <div class="title-section mb-4 text-center item-index">
                <p class="fw-bolder h2 mb-4 title">{!! @$settings['first_page_gallery_title'] !!}</p>
            </div>
            <div
                class="col-xxl-5 col-xl-6 col-lg-7 col-md-7 col-sm-9 col-12 m-auto p-0 position-relative height-over item-index">
                <ul class="d-flex flex-wrap align-items-center justify-content-center m-0 p-0">
                    @forelse($gallery_categories as $gallery_category)
                        <li class="gallery-item p-1">
                            {{-- Review : add href--}}
                            <a href="{{ route('gallery.list', ['url' => $gallery_category['url']]) }}" class="gallery-link font-th dynamic-color-hover" onmouseenter="updateTextColorHover(event)" onmouseleave="event.target.style.color = '#000' ">
                                {{$gallery_category['title']}}
                            </a>
                        </li>
                    @empty
                    <li class="gallery-item p-1">

                            <a href="{{route('gallery.category')}}" class="gallery-link font-th">
                                مشاهده دسته بندی گالری
                            </a>
                        </li>
                        {{-- در صورت خالی بودن Todo ui : : Done--}}
                    @endforelse
                </ul>
            </div>
            {{-- Review : add href--}}
            <a href="{{route('gallery.category')}}" class="btn-arrow position-relative item-index h-rotate d-md-flex d-none">
                {!! @$settings['gallery_button'] !!}
                <span class="arrow-box">
                <i class="bi bi-arrow-up-left d-flex main-icon dynamic-color fs-5"></i>
                </span>
            </a>
            <div class="banner-scrollable overflow-hidden d-flex flex-nowrap">
                <div class="scroll-text">
                    <p class="font-playfair">
                        {!! @$settings['first_page_gallery_animation'] !!}
                    </p>
                </div>
                <div class="scroll-text">
                    <p class="font-playfair">
                        {!! @$settings['first_page_gallery_animation'] !!}
                    </p>
                </div>
            </div>
        </div>
        {{--gallery mobile--}}
        <div class="d-md-none d-block">
            <div class="gallery-collection-mobile d-flex flex-column flex-wrap">
                @foreach($galleries as $gallery)
                    <div class="item p-1">
                        <img src="{{$gallery['item_image']}}" alt="{{$gallery['title']}}" title="{{$gallery['title']}}" class="w-100 h-100" loading="lazy">
                    </div>
                @endforeach
            </div>
            {{-- Review : add href--}}
            <a href="{{route('gallery.category')}}"
               class="btn-arrow position-relative item-index h-rotate d-flex justify-content-between align-items-center">
                {!! @$settings['gallery_button'] !!}
                <span class="arrow-box">
                    <img src="{{asset('assets/site/images/left-top-arrow-dark.svg')}}" class="main-icon" width="25" height="25"
                             alt="آیکن فلش" title="آیکن فلش" loading="lazy">
                </span>
            </a>
        </div>
    </div>
    @foreach ($galleries as $index => $gallery)
        @if ($index >= 3 && $index < 6)
            <div class="gallery-item-img d-md-block d-none">
                <img src="{{$gallery['item_image']}}" alt="{{$gallery['title']}}" title="{{$gallery['title']}}" loading="lazy">
            </div>
        @endif
    @endforeach
</section>
@endif
