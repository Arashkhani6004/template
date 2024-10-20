<div class="row w-100 m-0">
    @forelse($services as $row)
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 p-xxl-3 p-xl-2 p-lg-2 p-sm-2 p-1 mb-sm-0 mb-4">
            <div class="list-card position-relative">
                <a href="{{ route('service.detail', ['url' => $row['url']]) }}">
                    <img src="{{$row['image']}}" class="w-100" alt="{{$row['title']}}" title="{{$row['title']}}" loading="lazy">
                </a>
                <div class="sub-cat">
                    <a href="{{ route('service.detail', ['url' => $row['url']]) }}" class="btn-arrow h-rotate w-100" >
                        {{$row['title']}}
                        <span class="arrow-box">
                                    <i class="bi bi-chevron-down d-flex fs-5 dynamic-color"></i>
                                </span>
                    </a>
                </div>
            </div>
        </div>
    @empty
{{--        //Todo ui: خالی بودن لیست--}}
    @endforelse
</div>
