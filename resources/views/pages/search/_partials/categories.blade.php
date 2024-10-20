<div class="product-category">
    <div class="title-section mb-4 px-md-2 px-1">
        <p class="fw-bolder h5 mb-1 title">دسته بندی محصولات</p>
        <p class="font-th small op-lighter short-des">
            محصولات یافت شده مرتبط با "{{$search}}"
        </p>
    </div>
    <div class="row w-100 m-0">
        @forelse($searched_categories as $searched_category)
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 p-md-2 p-1">
            <div class="cat-card">
                <a href="{{ route('category.detail', ['url' => $searched_category['url']]) }}" class="h-rotate color-title">
                    <p class="font-md mb-0">
                        <span class="font-bold">{{$searched_category['title']}}</span>
                    </p>
                </a>
            </div>
        </div>
        @empty
            {{--            //Todo ui : قسمت خالی بودن --}}
        @endforelse

    </div>
</div>
