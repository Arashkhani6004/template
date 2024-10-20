<div class="sidebar-cart bg-white rounded-3 shadow-sm px-2 py-3" v-if="priceLoading == false">
    <ul class="m-0 p-0">
        <li class="list-unstyled d-flex justify-content-between mb-3 d-lg-flex d-none" v-if="priceSum">
            <p class="font-md m-0 small">
                قیمت کالاها
            </p>
            <p class="font-num-r m-0 small">
                @{{ priceSum }}
            </p>
        </li>
        <li class="list-unstyled d-flex justify-content-between mb-3" v-if="priceDiscount">
            <p class="font-md m-0 small">
                تخفیف
            </p>
            <p class="font-num-r m-0 small">
                @{{ priceDiscount }}
            </p>
        </li>
        <li class="list-unstyled d-flex justify-content-between mb-3" v-if="finalPriceSum">
            <p class="font-md m-0 small">
                مبلغ کل
            </p>
            <p class="font-num-r m-0 small">
                @{{ finalPriceSum }}
            </p>
        </li>
        <li class="list-unstyled d-flex justify-content-between  d-lg-flex d-none">
            <a href="{{route('basket.shipping')}}" class="btn btn-one-outline dynamic-color py-2 w-100">
                تایید و تکمیل سفارش
            </a>
        </li>
    </ul>
</div>
<div class="sidebar-cart bg-white rounded-3 shadow-sm px-2 py-3 d-flex justify-content-center align-items-center" v-else>
    @include("layouts.common.loading")
</div>
