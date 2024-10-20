<input type="hidden" name="basket_id" value="{{@$basket->id}}">
<div class="row w-100 m-0">
    <div class="col-md-4 col-6 p-1">
        <label class="form-label font-small font-re mb-1" for="subject">نام تحویل گیرنده</label>
        <input class="form-control" placeholder="مثلا رامین جوادی" id="subject" value=""
               required
               name="receiptor_full_name" v-model="receiptorName">
    </div>
    <div class="col-md-4 col-6 p-1">
        <label class="form-label font-small font-re mb-1" for="subject">شماره تحویل گیرنده</label>
        <input class="form-control" placeholder="مثلا ۰۹۱۲۱۲۳۴۵۶۷" id="subject" value=""
               required
               name="receiptor_mobile" v-model="receiptorMobile">
    </div>
    <div class="col-md-4 col-6 p-1">
        <label class="form-label font-small font-re mb-1" for="postalCode">کدپستی</label>
        <input class="form-control" placeholder="1234567890" id="postalCode" value=""
               name="postal_code" v-model="postalCodeForm">
    </div>
    <div class="col-md-6 col-6 p-1">
        <label class="form-label font-small font-re mb-1">استان</label>
        <select class="form-select" aria-label="Default select example"
                name="state_id" required
                v-model="selectedState"
                @change="setCities(selectedState)">
            <option value="">استان محل سکونت</option>
            <option v-for="state in states" :value="state.id">@{{ state.name }}
            </option>
        </select>
    </div>
    <div class="col-md-6 col-6 p-1">
        <label class="form-label font-small font-re mb-1">
            شهر
            <div class="spinner-border spinner-border-sm ms-2" role="status" v-if="loadingAddress === true">
                <span class="visually-hidden">Loading...</span>
            </div>
        </label>

        <select class="form-select" aria-label="Default select example"
                required name="city_id" v-model="selectedCity">

            <option value="">شهر محل سکونت</option>
            <option v-for="city in cities" :value="city.id"> @{{city.name}} </option>
        </select>
    </div>
    <div class="col-12 p-1">
        <label class="form-label font-small font-re mb-1" for="exampleFormControlTextarea1">آدرس</label>
        <textarea class="form-control small" name="address" placeholder="خیابان اصلی,خیابان فرعی,کوچه" id="exampleFormControlTextarea1" rows="3"
                  v-model="address"></textarea>
    </div>
    <div class="d-flex justify-content-center mt-1">
        <button type="submit" class="btn btn-one-outline dynamic-color btn-sm py-2 px-3">ثبت
            </button>
    </div>
</div>
