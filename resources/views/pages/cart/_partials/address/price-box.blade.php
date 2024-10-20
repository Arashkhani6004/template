<div class="sidebar-cart bg-white rounded-3 shadow-sm px-2 py-3"  v-if="priceLoading == false">
    <ul class="m-0 p-0">
        <li class="list-unstyled d-flex justify-content-between mb-3" v-if="priceShipping">
            <p class="font-md m-0 small">
                هزینه ارسال
            </p>
            <p class="font-num-r m-0 small">
              @{{ priceShipping }}
            </p>
        </li>
        <li class="list-unstyled d-flex justify-content-between mb-3" v-if="finalPriceSum">
            <p class="font-md m-0 small">
                مبلغ کل کالا
            </p>
            <p class="font-num-r m-0 small">
                @{{ finalPriceSum }}
            </p>
        </li>
        <li class="list-unstyled d-flex justify-content-between mb-3" v-if="priceCart">
            <p class="font-md m-0 small">
                مبلغ کل
            </p>
            <p class="font-num-r m-0 small">
                @{{ priceCart }}
            </p>
        </li>
{{--        <li class="list-unstyled d-flex justify-content-between mb-3">--}}
{{--            <p class="font-md m-0 small">--}}
{{--                ارزش افزوده--}}
{{--            </p>--}}
{{--            <p class="font-num-r m-0 small">--}}
{{--                28,000 تومان--}}
{{--            </p>--}}
{{--        </li>--}}
        <li class="list-unstyled d-flex justify-content-between  d-lg-flex d-none">
            <a href="{{route('basket.payment')}}" class="btn btn-one-outline dynamic-color py-2 w-100">
                تایید و تکمیل سفارش
            </a>
        </li>
    </ul>
</div>
<div class="sidebar-cart bg-white rounded-3 shadow-sm px-2 py-3 d-flex justify-content-center align-items-center" v-else>
    @include("layouts.common.loading")
</div>
