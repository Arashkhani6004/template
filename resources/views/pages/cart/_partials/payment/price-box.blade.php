<div class="col-xl-3 col-lg-4 pe-0 ps-0 ps-lg-2 mt-4" id="pay">
    <div class="sidebar-cart bg-white rounded-3 shadow-sm px-2 py-3" v-if="priceLoading == false">
        <div class=" form-group position-relative">
            <input type="text" placeholder="کد تخفیف" class="form-control shadow-none code" v-model="discountCode">
            <button v-if="discountId === ''" class="btn btn-sm py-1 px-3 btn-one-outline dynamic-color position-absolute top-0 bottom-0 end-0 rounded-3" @click="addDiscount()">
                ثبت
            </button>
            <button v-else class="btn btn-sm py-1 px-3 btn-one-outline dynamic-color position-absolute top-0 bottom-0 end-0 rounded-3" @click="deleteDiscount()">
                حذف
            </button>
        </div>
        <form v-if="priceLoading == false" action="{{route('basket.order-create')}}" method="POST">
            @csrf
        <ul class="m-0 p-0 mt-3">
            <li class="list-unstyled d-flex justify-content-between mb-3" v-if="priceSum">
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
            <li class="list-unstyled d-flex justify-content-between mb-3" v-if="discountAmount">
                <p class="font-md m-0 small">
                  کد تخفیف
                </p>
                <p class="font-num-r m-0 small">
                    @{{ discountAmount }}
                </p>
            </li>
            <li class="list-unstyled d-flex justify-content-between mb-3" v-if="priceCart">
                <p class="font-bold m-0 small">
                    مبلغ پرداختی
                </p>
                <p class="font-num-r fw-bold m-0 small">
                    @{{ priceCart }}
                </p>
            </li>
            <hr>
            <li class=" list-unstyled">
                <p class="small font-bold mb-1">روش پرداخت</p>
                <ul class="d-flex align-items-center p-0 m-0 mb-2 gap-2">
                    @foreach($banks as $bank)
                    <li class="list-unstyled pay-item rounded-3 d-flex flex-column align-items-center p-1">
                        <input class="form-check-input" required
                               @invalid="warnRequired('روش پرداخت ')"
                               @if(count($banks) == 1) checked @endif
                               type="radio" name="bank_id" id="flexRadioDefault1" value="{{$bank->id}}">
                        <label class="form-check-label mt-2" for="flexRadioDefault1">
                            <img src="{{$bank->item_image}}" width="60" class="rounded-2" />
                        </label>

                    </li>
                    @endforeach
                </ul>
            </li>
            <li class="list-unstyled d-flex justify-content-between">
                <button type="submit" class="btn btn-one-outline dynamic-color py-2 w-100">
                    تایید و تکمیل سفارش
                </button>
            </li>
        </ul>
        </form>
    </div>
    <div class="sidebar-cart bg-white rounded-3 shadow-sm px-2 py-3 d-flex justify-content-center align-items-center" v-else>
        @include("layouts.common.loading")
    </div>

</div>
