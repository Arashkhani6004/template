<div class="container-fluid">
    <div class="card-block row w-100 m-0">
        <div class="col-xxl-3 col-sm-6 col-12 p-2">
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
        <div class="col-xxl-3 col-sm-6 col-12 p-2">
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
        <div class="col-xxl-3 col-sm-6 col-12 p-2">
            <x-cms-select
                name="parent_id"
                label="خدمت والد"
                :options="$services"
                optionValue="id"
                optionLabel="title"
                :searchable="true"
                :clearable="true"
                :selectedOption="isset($data->parent_id) ? $data->parent_id : null"
            />
        </div>
        <div class="col-xxl-3 col-sm-6 col-12 p-2">
            <x-cms-image-input
                name="image"
                label="تصویر"
                :imageSrc="(isset($data) && $data->image) ? $data->image : null"
                :deletable="true"
                :deleteUrl="'model='.\Rahweb\CmsCore\Modules\Service\Entities\Service::class.'&id='.@$data['id']"
                width="1200"
                height="515"
                 cropper="1"
            />
        </div>
        <div class="col-xxl-3 col-sm-6 col-12 p-2">
            <x-cms-image-input
                name="header_image"
                label="تصویر هدر"
                :imageSrc="(isset($data) && $data->header_image) ? $data->header_image : null"
                :deletable="true"
                :deleteUrl="'model='.\Rahweb\CmsCore\Modules\Service\Entities\Service::class.'&id='.@$data['id']"
            />
        </div>
        <div class="col-xxl-3 col-sm-6 col-12 p-2">
            <div class="form-group">
                <x-cms-input
                    name="phone_number"
                    label="شماره کارشناس مربوطه"
                    :validations="['numberCms']"
                    type="text"
                    :valueData="@$data"
                />
            </div>
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
                <div class="form-group">
                    <x-cms-text-area
                        name="short_description"
                        label="توضیحات کوتاه"
                        type="text"
                        :valueData="@$data"
                    />
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 p-2">
            <div class="form-group">
                <x-cms-check-box
                    name="show_in_first_page"
                    label="نمایش در صفحه اول"
                    :valueData="@$data"
                />
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 p-2">
            <div class="form-group">
                <x-cms-check-box
                    name="show_in_layout"
                    label="نمایش در منو و فوتر"
                    :valueData="@$data"
                />
            </div>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6 col-12 ms-auto p-2">
            <button type="submit" id="submitFormCms" class="btn btn-custom rounded-custom w-fit px-3 py-2">
                ذخیره
            </button>
        </div>
    </div>
</div>
