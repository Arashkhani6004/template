<div class="container-fluid">
    <div class="card-block row w-100 m-0">
        <div class="col-xxl-3 col-sm-6 p-2">
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
        <div class="col-xxl-3 col-sm-6 p-2">
            <div class="form-group">
                <x-cms-input
                    name="url"
                    label="آدرس url"
                    :validations="['requiredCms','urlCms']"
                    type="text"
                    :valueData="@$data"
                />
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6 p-2">
            <div class="form-group">
                <x-cms-input
                    name="author"
                    label="نام نویسنده"
                    type="text"
                    :valueData="@$data"
                />
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6 p-2">
            <div class="form-group">
                <label>تاریخ انتشار</label>

                <input class="form-control bg-light rounded-custom" type="text" id="datepicker1" name="publish_date" placeholder="تاریخ انتشار" value="@if(isset($data)){{jdate('d/m/Y',\Carbon\Carbon::parse(@$data->publish_date)->timestamp)}} @endif">
            </div>
        </div>

        <div class="col-xxl-3 col-sm-6 p-2">
            <x-cms-select
                name="parent_id"
                label="دسته بندی"
                :options="$category"
                optionValue="id"
                optionLabel="title"
                :searchable="true"
                :selectedOption="isset($data->parent_id) ? $data->parent_id : null"
            />
        </div>
        <div class="col-xxl-3 col-sm-6 p-2">
            <x-cms-multi-select
                name="services"
                label="خدمات"
                :options="$services"
                optionValue="id"
                optionLabel="title"
                :searchable="true"
                :selectedOptions="isset($data) ? $data->services->map(function($item){return $item->id;})->toArray() : []"
            />
        </div>

        <div class="col-xxl-3 col-sm-6 p-2">
            <x-cms-image-input
                name="image"
                label="تصویر "
                :imageSrc="(isset($data) && $data->image) ? $data->item_image : null"
                :validations="['requiredCms']"
            />
        </div>

        <div class="col-12 p-2">
            <div class="form-group">
                <x-cms-ck-editor
                    name="description"
                    label="توضیحات"
                    type="text"
                    :valueData="@$data"
                />
            </div>
        </div>
        <div class="col-12 p-2">
            <div class="form-group">
                <x-cms-check-box
                    name="call_to_action"
                    label="نمایش دکمه تماس با کارشناسان"
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

@push('scripts')
    <script src="{{asset('assets/admin/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/bootstrap-datepicker.fa.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $("#datepicker1").datepicker({
                changeMonth: true,
                changeYear: true
            });
        });
    </script>
@endpush
