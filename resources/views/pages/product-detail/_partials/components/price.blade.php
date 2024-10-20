    <div class="old-price" v-if="price != 0">
        <p class="m-0 font-num-r">
         @{{ price }}
        </p>
    </div>
<p class="font-num fw-bold m-0 h4">
    @{{ finalPrice }}
</p>

    <div class="off font-num-r" v-if="percent != 0">
        @{{ percent }}%
    </div>
