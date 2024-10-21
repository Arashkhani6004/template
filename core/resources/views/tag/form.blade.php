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
            <x-cms-image-input
                name="image"
                label="تصویر "
                :imageSrc="(isset($data) && $data->image) ? $data->item_image : null"

            />
        </div>
        <div class="col-xxl-3 col-sm-6 p-2">
            <x-cms-image-input
                name="first_page_image"
                label="تصویر بک گراند صفحه اول "
                :imageSrc="(isset($data) && $data->first_page_image) ? $data->item_first_page_image : null"
                width="1000"
                height="667"
                cropper="1"
            />
        </div>
        <div class="col-xxl-3 col-sm-6 p-2">
            <x-cms-image-input
                name="first_page_image"
                label="تصویر آیکون صفحه اول "
                :imageSrc="(isset($data) && $data->first_page_icon) ? $data->item_first_page_icon : null"
                width="196"
                height="318"
                cropper="1"
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
        <div class="col-lg-3 col-sm-6 col-12 p-2">
            <div class="form-group">
                <x-cms-check-box
                    name="active"
                    label="نمایش "
                    :valueData="@$data"
                />
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
        <div class="w-100 pe-0">
            <button type="submit" id="submitFormCms" class="btn btn-custom rounded-custom w-fit px-3 py-2">
                ذخیره
            </button>
        </div>
        </div>
    </div>

