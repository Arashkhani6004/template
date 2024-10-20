<section class="hero position-relative">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{$package->getImage()}}" class="w-100" alt="{{$package['title']}}" title="{{$package['title']}}" />
        </div>
    </div>
    <div
        class="over-hero position-absolute top-0 bottom-0 end-0 start-0 d-flex align-items-sm-end align-items-end justify-content-start">
        <div class="hero-content container">
            <div class="row w-100 m-0">
                <div class="col-md-4 col-12 p-1 d-lg-none d-block">
                    <div class="img-header-inner">
                        <img src="{{$package->getImage()}}" class="w-100" alt="{{$package['title']}}"
                            title="{{$package['title']}}">
                    </div>
                </div>
                <div class="col-xxl-9 col-xl-9 col-lg-8 col-md-8 col-sm-12 col-12 p-2 align-self-center ms-auto">
                    <h1 class="mb-sm-2 mb-1 fw-bold light">{{$package['title']}}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{route('index')}}" class="d-flex align-items-cente text-light font-re">
                                    <i class="bi bi-house d-flex me-1"></i>
                                    خانه
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('package.list')}}" class="d-flex align-items-cente text-light font-re">
                                    پکیج ها
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-light" aria-current="page">
                                {{$package['title']}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
