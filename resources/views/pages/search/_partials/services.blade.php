<div class="services">
    <div class="title-section mb-4 px-md-2 px-1">
        <p class="fw-bolder h5 mb-1 title">خدمات</p>
        <p class="font-th small op-lighter short-des">
            خدمات یافت شده مرتبط با "{{$search}}"
        </p>
    </div>
    <div class="row w-100 m-0">
        @forelse($searched_services as $searched_service)
        <div class="col-xxl-4 col-xl-4 col-lg-4 col-sm-6 p-md-2 p-1">
            <div class="list-card position-relative">
                <a href="{{ route('service.detail', ['url' => $searched_service['url']]) }}">
                    <img src="{{$searched_service['image']}}" class="w-100" alt="{{$searched_service['title']}}" loading="lazy">
                </a>
                <div class="sub-cat">
                    <a href="{{ route('service.detail', ['url' => $searched_service['url']]) }}" class="btn-arrow h-rotate w-100" type="button">
                        {{$searched_service['title']}}
                        <span class="arrow-box">
                                    <i class="bi bi-chevron-down d-flex fs-5"></i>
                                </span>
                    </a>
                </div>
            </div>
        </div>
        @empty
            {{--        //Todo ui: خالی بودن لیست--}}
        @endforelse
    </div>
</div>
