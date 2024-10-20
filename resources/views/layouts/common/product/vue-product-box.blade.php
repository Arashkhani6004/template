<a :href="product.vue_url" class="color-title">
    <div class="product-card">
        <div class="off font-num-r" v-if="product.percent != null">
            @{{ product.percent }}%
        </div>
        <div class="row w-100 m-0">
            <div class="col-sm-12 col-4 p-sm-0 p-0">
                <img :src="product.image" class="w-100" :alt="product.title" :title="product.title" loading="lazy">

            </div>
            <div class="col-sm-12 col-8 p-sm-0 p-0 align-self-center">
                <div class="p-2">
                    <div class="name text-sm-center">
                        <p class="font-bold m-0">@{{ product.title }}</p>
                    </div>
                    {{-- <div class="colors mt-2">--}}
                    {{-- <ul class="p-0 m-0 d-flex justify-content-center align-items-center gap-2 flex-wrap">--}}
                    {{-- <li class="list-unstyled m-0" style="background-color: red;">--}}
                    {{-- </li>--}}
                    {{-- <li class="list-unstyled m-0" style="background-color: blue;">--}}
                    {{-- </li>--}}
                    {{-- <li class="list-unstyled m-0" style="background-color: antiquewhite;">--}}
                    {{-- </li>--}}
                    {{-- </ul>--}}
                    {{-- </div>--}}
                    <div class="price mt-2 align-items-sm-center" v-if="product.final_price != 0 || product.price != null">
                        <p class="m-0 font-num-r fw-bolder" v-if="product.final_price != 0">@{{ product.final_price }} تومان</p>
                        <div class="old-price" v-if="product.price != null">
                            <p class="m-0 font-num-r">@{{ product.price }} تومان </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</a>
