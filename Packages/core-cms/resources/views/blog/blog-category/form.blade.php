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
                :deletable="true"
                :deleteUrl="'model='.BlogCategory::class.'&id='.@$data['id']"
            />
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
                    name="status"
                    label="نمایش در منو"
                    :valueData="@$data"
                />
            </div>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6 col-12 ms-auto p-2">
            <button type="submit" id="submitFormCms" class="btn btn-custom rounded-custom w-25">
                ذخیره
            </button>
        </div>
    </div>
</div>
@push('scripts')
    @include('CmsCore::_layouts.blocks.utils.ckeditor-scripts')
@endpush
