<div class="blogs">
    <div class="title-section mb-4 px-md-2 px-1">
        <p class="fw-bolder h5 mb-1 title">مطالب</p>
        <p class="font-th small op-lighter short-des">
            مطالب یافت شده مرتبط با "{{$search}}"
        </p>
    </div>
    <div class="row w-100 m-0">
        @forelse($searched_blogs as $searched_blog)
        <div class="col-xxl-4 col-xl-4 col-lg-4 col-sm-6 p-md-2 p-1">
            <div class="package-card">
                <a href="{{ route('blog.detail', ['url' => $searched_blog['url']]) }}" class="color-title text-start h-rotate">
                    <img src="{{$searched_blog['image']}}" class="w-100 main-image" alt="{{$searched_blog['title']}}"
                         title="{{$searched_blog['title']}}">
                    <div class="py-4 px-3">
                        <div class="row w-100 m-0 mb-3">
                            <div class="col-lg-9 col-10 pe-1 p-0 align-self-center">
                                <div class="package-title">
                                    <p class="m-0 font-bold">
                                        {{$searched_blog['title']}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-2 ps-1 p-0 align-self-center">
                                <span class="arrow ms-auto">
                                    <img src="assets/site/images/left-top-arrow.svg" class="main-icon" alt="package-icon" title="package-icon">
                                </span>
                            </div>
                        </div>
                        <div class="short-des mb-3">
                            <p class="font-re small m-0">
                                {!! strip_tags(\Illuminate\Support\Str::limit($searched_blog['description'],170)) !!} </p>
                        </div>
                        <ul class="p-0 m-0 d-flex align-items-center justify-content-between pt-3 flex-wrap mb-2">
                            <li class="d-flex align-items-center font-re font-small text-secondary m-1">
                                <i class="bi bi-calendar4 color-theme-two fs-5 d-flex me-1"></i>
                                {{jdate('l j F Y',strtotime($searched_blog['publish_date']))}}
                            </li>
                            <li class="d-flex align-items-center font-re font-small text-secondary m-1">
                                <i class="bi bi-eye color-theme-two fs-5 d-flex me-1"></i>
                                {{$searched_blog['view']}}
                            </li>
                        </ul>
                        <p class="font-small font-re d-flex align-items-center m-1 text-secondary">
                            <i class="bi bi-clock d-flex me-1 color-theme-two fs-5"></i>
                            خواندن این مطلب {{$searched_blog['reading_time']}} دقیقه زمان خواهد برد
                        </p>
                    </div>
                </a>
            </div>
        </div>
        @empty
            {{--        //Todo ui: خالی بودن لیست--}}
        @endforelse


    </div>
</div>
