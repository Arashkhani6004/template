<div class="row w-100 m-0 p-0" v-if="loadingList == false">
<div class="col-sm-12 p-1"  v-for="(location, index) in locations" :key="location.id">
    <div class="address-item p-2 border">
        <div class="d-flex align-items-center justify-content-between">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="address_id"
                       v-model="defaultAddressId"
                       @change="getShippingMethod()"
                       :checked="location.id == defaultAddressId"
                       :id="'flexCheckDefault'+ location.id" :value="location.id">
                <label class="form-check-label small font-th" :for="'flexCheckDefault'+ location.id">
                    آدرس جهت ارسال
                </label>
            </div>
            <a @click="editAddress(location.id)" class="color-title d-flex align-items-center font-small font-re" data-bs-toggle="collapse" :href="'#editAdress-' + location.id" role="button" aria-expanded="false" aria-controls="collapseExample">
                <i class="bi bi-pencil d-flex me-1"></i>
                ویرایش
            </a>
        </div>
        <p class="font-md m-0 mt-2">

            @{{ location.state_name }}
            |
            @{{ location.city_name }}
        </p>
        <p class="font-th m-0 small mt-1">
            @{{ location.address }}
        </p>
        <div class="collapse mt-2" :id="'editAdress-' + location.id">
            <div class="card card-body p-2 edit-card">
                @include('pages.cart._partials.address.edit-form')
            </div>
        </div>
    </div>
</div>
</div>
<div class="row w-100 m-0" v-else>
    <div class="col-xl-6 m-auto text-center">
        @include("layouts.common.loading")
    </div>
</div>

