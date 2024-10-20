<div class="row-100 m-0" v-if="this.loadingShipment == false">
<div class="time-post mt-4" v-if="shippingMethods.length > 0">
    <div class="d-flex align-items-center justify-content-between">
        <p class="font-bold m-0">روش ارسال</p>
    </div>
    <hr class="my-2">
    <div class="row w-100 m-0" v-if="this.loadingShipment == false">
        <div class="col-xl-6 col-sm-12 p-1" v-for="shippingMethod in shippingMethods">
            <div class="address-item p-2 border">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="shipping_method_id" v-model="defaultShippingMethodId"
                            @change="setShippingMethod()"
                            :checked="shippingMethod.id == defaultShippingMethodId"
                            :id="'flexCheckDefault-'+ shippingMethod.id" :value="shippingMethod.id">
                        <label class="form-check-label small font-th" :for="'flexCheckDefault-'+ shippingMethod.id">
                            انتخاب
                        </label>
                    </div>
                </div>
                <p class="font-md m-0 mt-2">
                    @{{ shippingMethod.title }}
                </p>
                {{-- <p class="font-th m-0 small mt-1 mb-0">--}}
                {{-- ارسال با فوروارد، تحویل بین 24 الی 48 ساعت--}}
                {{-- </p>--}}
                <p class="font-md small m-0 mt-1">هزینه ارسال : <span class="font-num-r">@{{ formatPrice(shippingMethod.price) }} تومان</span></p>
            </div>
        </div>
    </div>
    <div class="row w-100 m-0" v-else>
        <div class="col-xl-6 m-auto text-center">
            @include("layouts.common.loading")
        </div>
    </div>
</div>
</div>
<div class="row-100 m-0" v-else>
    <div class="col-xl-6 m-auto text-center">
        @include("layouts.common.loading")
    </div>
</div>
