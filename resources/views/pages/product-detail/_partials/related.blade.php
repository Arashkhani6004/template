@if(count($related_products) > 0)
    <div class="related-products">
        <div
            class="title-section position-relative mb-sm-0 mb-4 text-center col-xxl-6 col-xl-7 col-lg-8 col-md-12 m-auto p-0">
            <p class="fw-bolder h2 mb-4 title">محصولات مرتبط</p>
            <p class="font-re short-des">
                طبق نظر و سلیقه ی شما محصولات زیر را گردآوری کرده ایم
            </p>
        </div>
        <div dir="rtl" class="swiper swiper-team">
            <div class="swiper-wrapper py-sm-5 py-3">
                @foreach($related_products  as $related_product)
                    <div class="swiper-slide">
                        @include('layouts.common.product.product-box',['product' => $related_product])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
