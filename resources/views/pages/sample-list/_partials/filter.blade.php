<div class="sort-form">
                    <p class=" d-flex align-items-center mb-2">
                        <i class="bi bi-sort-up-alt d-flex fs-5 me-1"></i>
                        مرتب سازی براساس
                    </p>
                    <ul class="m-0 p-0">
                        <li class="list-unstyled font-re small">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="radio" name="flexRadioDisabled" id="sort-item1">
                                <label class="form-check-label w-100" for="sort-item1">
                                    جدیدترین
                                </label>
                            </div>
                        </li>
{{--                        //Todo: تعیین تکلیف--}}
                        <li class="list-unstyled font-re small">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="radio" name="flexRadioDisabled" id="sort-item2">
                                <label class="form-check-label w-100" for="sort-item2">
                                    پربازدیدترین
                                </label>
                            </div>
                        </li>
                        <li class="list-unstyled font-re small">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="radio" name="flexRadioDisabled" id="sort-item3">
                                <label class="form-check-label w-100" for="sort-item3">
                                    منتخب
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
<div id="samples">
    <div class="filter mt-5">
        <p class="d-flex align-items-center mb-2">
            <i class="bi bi-funnel d-flex fs-5 me-1"></i>
            فیلتر نمونه کارها
        </p>
        <ul class="m-0 p-0 mt-2">
            <p class="font-re small mb-1">انتخاب خدمات</p>
            <li class="list-unstyled font-re small">
                <select class="form-select" aria-label="Default select example" v-model="selectedService">
                    <option value="" selected>لطفاً خدمت مورد نظر خود را انتخاب کنید</option>
                    <option v-for="service in services" :value="service.id">@{{ service.title }}</option>
                </select>
            </li>
        </ul>

        <ul v-if="selectedService">
            <template v-for="level in 6">
                <template v-if="selectedSubServices[level] && selectedSubServices[level].length > 0">
                    <ul class="m-0 p-0 mt-2">
                        <p class="font-re small mb-1">زیرگروه خدمات - سطح @{{ level }}</p>
                        <li class="list-unstyled font-re small">
                            <select class="form-select" aria-label="Default select example" v-model="selectedSubServiceLevel[level]" @change="updateSubServices(level + 1)">
                                <option value="" selected>لطفاً زیرگروه مورد نظر خود را انتخاب کنید</option>
                                <option v-for="subService in selectedSubServices[level]" :value="subService.id">@{{ subService.title }}</option>
                            </select>
                        </li>
                    </ul>
                </template>
            </template>
        </ul>
    </div>
</div>
