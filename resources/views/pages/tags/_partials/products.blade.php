<div class="products">
    <div class="title-section mb-4 px-md-2 px-1">
        <p class="fw-bolder h5 mb-1 title">محصولات</p>
        <p class="font-th small op-lighter short-des">
            محصولات تگ {{$tag['title']}}
        </p>
    </div>
    <div class="row w-100 m-0 lists">

        @forelse($products as $product)
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 p-sm-2 p-1">
                @include('layouts.common.product.product-box')
            </div>
        @empty
            {{--            //Todo ui : قسمت خالی بودن --}}
        @endforelse

        @component("layouts.common.pagination.default")
            @slot("paginator",$products)
        @endcomponent
    </div>
</div>
