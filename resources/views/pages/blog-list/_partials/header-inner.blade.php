<section class="hero position-relative">
    <div id="carouselExample" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{$blog_category->item_image}}" class="w-100" alt="{{$blog_category['title']}}" title="{{$blog_category['title']}}">
            </div>
        </div>
    </div>
    <div
        class="over-hero position-absolute top-0 bottom-0 end-0 start-0 d-flex align-items-sm-end align-items-end justify-content-start ">
        <div class="hero-content container">
            <div class="row w-100 m-0">
                <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 p-0 pe-lg-4">
                    <h1 class="mb-sm-1 mb-1 fw-bold light">
                        {{$blog_category['title']}}
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('index')}}" class="d-flex align-items-cente text-light font-re">
                                    <i class="bi bi-house d-flex me-1"></i>
                                    خانه
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="{{route('blog.category-list')}}" class="d-flex align-items-cente text-light font-re">
                                    مطالب
                                </a>
                            </li>
                            @if($blog_category->parent)
                                <li class="breadcrumb-item"><a href="{{ route('blog.list', ['url' => @$blog_category->parent->url]) }}" class="text-light font-re">
                                        {{@$blog_category->parent->title}}</a></li>
                            @endif
                            <li class="breadcrumb-item active text-light" aria-current="page">{{$blog_category['title']}}</li>
                        </ol>
                    </nav>

                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.common.banner-scrollable-animation')
