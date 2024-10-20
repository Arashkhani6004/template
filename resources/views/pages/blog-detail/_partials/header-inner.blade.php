<section class="hero position-relative">
    <div id="carouselExample" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{@$blog->item_image}}" class="w-100" alt="{{@$blog['title']}}" title="{{@$blog['title']}}">
            </div>
        </div>
    </div>
    <div
        class="over-hero position-absolute top-0 bottom-0 end-0 start-0 d-flex align-items-sm-end align-items-end justify-content-start ">
        <div class="hero-content container">
            <div class="row w-100 m-0">
                <div class="col-md-4 col-12 p-1 d-lg-none d-block">
                @include('pages.blog-detail._partials.main-img')
                </div>
                <div class="col-xxl-9 col-xl-9 col-lg-8 col-md-8 col-sm-12 col-12 p-1 align-self-center ms-auto">
                    <h1 class="mb-sm-1 mb-1 fw-bold light">
                     {{@$blog['title']}}
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index')}}"
                                    class="d-flex font-re align-items-center text-light"><i
                                        class="bi bi-house d-flex me-1"></i>خانه</a></li>
                            <li class="breadcrumb-item"><a href="{{route('blog.category-list')}}" class="text-light font-re">مطالب</a></li>
                            @if($blog->category->parent)
                            <li class="breadcrumb-item"><a href="{{ route('blog.list', ['url' => @$blog->category->parent->url]) }}" class="text-light font-re">{{@$blog->category->parent->title}}</a></li>
                            @endif
                                <li class="breadcrumb-item"><a href="{{ route('blog.list', ['url' => @$blog->category->url]) }}" class="text-light font-re">{{@$blog->category->title}}</a></li>
                            <li class="breadcrumb-item active text-light" aria-current="page">{{@$blog['title']}}</li>
                        </ol>
                    </nav>
                    <div class="info">
                        <ul class="p-0 m-0 d-flex align-items-center flex-wrap">
                            @if(@$blog['author'] != null)
                            <li class="list-unstyled d-flex align-items-center info-item me-4 m-1 mb-sm-1 mb-2 font-re">
                                <i class="bi bi-pencil me-1 text-white fs-6"></i>
                                <p class="m-0 me-1">نویسنده: </p>
                                {{@$blog['author']}}
                            </li>
                            @endif
                            <li class="list-unstyled d-flex align-items-center info-item me-4 m-1 mb-sm-1 mb-2 font-re">
                                <i class="bi bi-calendar4 me-1 text-white fs-6"></i>
                                <p class="m-0 me-1">تاریخ انتشار: </p>
                                {{jdate('l j F Y',strtotime(@$blog['publish_date']))}}
                            </li>
                            <li class="list-unstyled d-flex align-items-center info-item me-4 m-1 mb-sm-1 mb-2 font-re">
                                <button type="button" class="btn btn-two btn-sm py-1 px-3 d-flex align-items-center"
                                    data-bs-toggle="modal" data-bs-target="#shareBlog">
                                    <i class="bi bi-share d-flex me-1"></i>
                                    اشتراک گذاری
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--                            //Todo:چک کردن برای دیوایس ها--}}
    <!-- share Modal -->
    @include('pages.blog-detail._partials.share-modal')
</section>
