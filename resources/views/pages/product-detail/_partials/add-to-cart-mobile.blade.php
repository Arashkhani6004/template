@if($product['final_price'] != 0 && $product['stock'] != 0)
    <div class="d-md-none d-block mobile-btn-cart" v-if="finalPrice != 0 && stock != 0">
        <div class="row w-100 m-0">
            <div class="col-12 px-2 pt-2">
                <div class="d-flex justify-content-between align-items-end">
                    <div class="price-inn text-start position-relative pe-5">
                        @include('pages.product-detail._partials.components.price')
                    </div>
                                    @include('pages.product-detail._partials.components.counter')
                </div>

            </div>
                    <div class="col-12 p-2 pt-0">
                        <div class="add-to-cart d-flex justify-content-center mt-2">
                            @include('pages.product-detail._partials.components.cart-btn')
                        </div>
                    </div>
        </div>
    </div>
@endif
