<template v-if="products.length > 0" class="row w-100 m-0">
    <div v-for="product in products" class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 p-sm-2 p-1">
    @include('layouts.common.product.vue-product-box')
    </div>
</template>
<template v-if="filterLoading == true">
    <div class="pulse-container p-0">
        <div class="pulse-bubble pulse-bubble-1"></div>
        <div class="pulse-bubble pulse-bubble-2"></div>
        <div class="pulse-bubble pulse-bubble-3"></div>
    </div>
</template>
<template v-if="isFilter == true && products.length == 0 && filterLoading == false && loading == false && titleLoading == false">
<div class="col-xxl-2 col-xl-3 col-lg-4 col-md-5 col-sm-6 col-5 p-0 m-auto align-self-center text-center">
        <img src="{{asset('assets/site/images/empty-states/Photos_empty.png')}}" class="w-100" alt="empty-state" title="empty-state" loading="lazy">
    </div>
    <p class="font-md mb-0 mt-3 text-center mb-3">
        محصولی یافت نشد!
    </p>
</template>
<template v-if="stopCall == false && loading == true && filterLoading == false">
    <div class="pulse-container p-0">
        <div class="pulse-bubble pulse-bubble-1"></div>
        <div class="pulse-bubble pulse-bubble-2"></div>
        <div class="pulse-bubble pulse-bubble-3"></div>
    </div>
</template>
