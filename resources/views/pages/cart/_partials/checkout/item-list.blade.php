<div class="row w-100 m-0">
    <div class="col-xxl-2 col-lg-3 col-sm-4 p-1">
        <img :src="item.product_image" class="w-100 rounded-4" :alt="item.product_title" :title="item.product_title" loading="lazy">
    </div>
    <div class="col-xxl-10 col-lg-9 col-sm-8 p-2">
        <div class="name mt-2 pe-4">
            <p class="font-bold mb-1 h5">
                @{{ item.product_title }}
            </p>
        </div>
        <div class="variables mt-3">
            <div class="d-flex align-items-center mt-2" v-if="item.variant_id">
                <p class="dont-bold small m-0 me-2"> @{{ item.main_variant_title }} : </p>
                <div class="d-flex align-items-center ">
                    <div class="color me-2" :style="{ backgroundColor: item.variant_color }" v-if="item.variant_color">
                    </div>
                    <p class="font-th small m-0">
                        @{{ item.variant_title }}
                    </p>
                </div>
            </div>
        </div>
        <div class="price mt-2">
            <div class="d-flex align-items-center">
                <p class="font-bold m-0 me-2">
                    قیمت :
                </p>
                <div class="d-flex align-items-center gap-4">
                    <div class="d-flex align-items-center " v-if="item.percent">
                        <p class="font-num-r percent m-0 me-2 dynamic-color">
                            %@{{ item.percent }}
                        </p>
                        <del class="font-num-r m-0 text-black-50" v-if="item.product_price != 0">
                            @{{ item.product_price }}
                        </del>
                    </div>

                    <p class="font-num-r m-0">
                        @{{item.product_final_price }}
                    </p>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center mt-3">
            <div class="number d-flex align-items-center justify-content-start ">
                <div class="value-button d-flex align-items-center justify-content-center dynamic-color decrease" @click="decreaseValue(index)">
                    <i class="bi bi-dash d-flex"></i>
                </div>
                <input type="text" class="font-num-r number-input" readonly :value="item.quantity" />
                <div class="value-button d-flex align-items-center justify-content-center dynamic-color increase" @click="increaseValue(index)">
                    <i class="bi bi-plus d-flex"></i>
                </div>
            </div>
            <div class="ms-2 input-loading" v-if="itemLoading === true">
                @include("layouts.common.loading")
            </div>
        </div>

    </div>

    <button @click="removeCart(item.id)" type="button" class="btn btn-trash">
        <i class="bi bi-trash d-flex"></i>
    </button>
</div>