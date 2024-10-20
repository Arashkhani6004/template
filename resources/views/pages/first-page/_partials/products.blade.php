@if(count($products) > 0)
<section class="products">
    <div class="container">
        <div class="list-pro">
            <div class="title mb-5">
                <p class="text-center font-bold">
                    محصولات فروشگاه
                </p>
            </div>
            <div class="tab-content mt-5">
                <div class="row w-100 m-0 lists" id="proFiltered">
                    @foreach($products as $product)
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 p-sm-2 p-1 product-filtered" data-category="beauty">
                        @include('layouts.common.product.product-box')
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif
