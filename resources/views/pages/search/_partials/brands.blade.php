<div class="product-brands ">
    <div class="title-section mb-4 px-md-2 px-1">
        <p class="fw-bolder h5 mb-1 title">برندها</p>
        <p class="font-th small op-lighter short-des">
            برندهای یافت شده مرتبط با "{{$search}}"
        </p>
    </div>
    <div class="row w-100 m-0">
        @forelse($searched_brands as $searched_brand)
        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 p-2">
            <div class="brand-card">
                <a href="{{$searched_brand['url']}}" class="h-rotate color-title d-flex align-items-center">
                    <i class="bi bi-caret-left-fill d-flex me-1 color-theme-one"></i>
                    <p class="font-md mb-0">
                        <span class="font-bold text-uppercase">{{$searched_brand['title']}}</span>
                    </p>
                </a>
            </div>
        </div>
        @empty
            {{--            //Todo ui : قسمت خالی بودن --}}
        @endforelse
    </div>
</div>
