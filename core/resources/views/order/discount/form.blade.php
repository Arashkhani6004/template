<div class="container-fluid">
    <div class="card-block row w-100 m-0">
        <div class="col-xxl-4 col-sm-6 p-2">
            <div class="form-group">
                <x-cms-input
                    name="title"
                    label="عنوان"
                    :validations="['requiredCms']"
                    type="text"
                    :valueData="@$data"
                />
            </div>
        </div>
        <div class="col-xxl-4 col-sm-6 p-2">
            <div class="form-group">
                <label>
                    نوع کد تخفیف
                </label>
                <select name="type" class="w-100 form-select bg-light rounded-custom " >
                    <option @if(isset($data) && $data->type == "cash") selected @endif value="cash">نقدی</option>
                    <option @if(isset($data) && $data->type == "percent") selected @endif value="percent">درصدی</option>
                </select>
            </div>
        </div>
        <div class="col-xxl-4 col-sm-6 p-2">
            <div class="form-group">
                <x-cms-input
                    name="amount"
                    label="مقدار(تومان یا درصد)"
                    :validations="['numberCms','requiredCms']"
                    type="text"
                    :valueData="@$data"
                />
            </div>
        </div>
        <div class="col-xxl-4 col-sm-6 p-2">
            <div class="form-group">
                <x-cms-input
                    name="count"
                    label="تعداد کد مورد نیاز "
                    :validations="['numberCms','requiredCms']"
                    type="text"
                    :valueData="@$data"
                />
            </div>
        </div>
        <div class="col-xxl-4 col-sm-6 p-2">
            <div class="form-group">
                <x-cms-input
                    name="basket_minimum_price"
                    label="حداقل مبلغ سبد خرید برای استفاده"
                    :validations="['numberCms']"
                    type="text"
                    :valueData="@$data"
                />
            </div>
        </div>
        <div class="col-xxl-4 col-sm-6 p-2">
            <div class="form-group">
                <x-cms-input
                    name="max_usage_per_user"
                    label="حداکثر استفاده هر کاربر"
                    :validations="['numberCms']"
                    type="text"
                    :valueData="@$data"
                />
            </div>
        </div>
        <div class="col-xxl-6 col-sm-6 p-2">
            <x-cms-select
                name="user_id"
                label=" کاربر"
                :options="$user"
                optionValue="id"
                optionLabel="full_name"
                :searchable="true"
                :selectedOption="isset($data->user_id) ? $data->user_id : null"
            />
        </div>


        <div class="col-lg-3 col-sm-6 col-12 p-2">
            <div class="form-group">
                <x-cms-check-box
                    name="first_purchase"
                    label="مخصوص خرید اول "
                    :valueData="@$data"
                    :value="0"
                />
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 p-2">
            <div class="form-group">
                <x-cms-check-box
                    name="with_discount"
                    label="قابل اعمال روی محصولات تخفیف دار  "
                    :valueData="@$data"
                />
            </div>
        </div>
        <div class="w-100 pe-0">
            <button type="submit" id="submitFormCms" class="btn btn-custom rounded-custom w-fit px-3 py-2">
                ذخیره
            </button>
        </div>
        </div>
    </div>
