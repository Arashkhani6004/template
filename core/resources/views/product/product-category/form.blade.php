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
                <x-cms-input
                    name="url"
                    label="آدرس url"
                    :validations="['requiredCms','urlCms']"
                    type="text"
                    :valueData="@$data"
                />
            </div>
        </div>
        <div class="col-xxl-4 col-sm-6 p-2">
            @php
                // تابع کمکی برای پیدا کردن سطح دسته
                function getCategoryLevel($categories, $categoryId) {
                    $level = 0;
                    while ($categoryId) {
                        $category = null;
                        foreach ($categories as $cat) {
                            if ($cat['id'] == $categoryId) {
                                $category = $cat;
                                break;
                            }
                        }
                        if ($category) {
                            $level++;
                            $categoryId = $category['parent_id'];
                        } else {
                            break;
                        }
                    }
                    return $level;
                }

                // تابع کمکی برای بررسی اینکه آیا دسته باید غیرفعال باشد یا نه
                function shouldDisableCategory($categories, $categoryId) {
                    $level = getCategoryLevel($categories, $categoryId);
                    return $level >= 3;
                }
            @endphp
            <label for="parent_id">
                دسته والد
            </label>
            <select
                id="parent_id"
                class="w-100 boot-select selectpicker"
                data-live-search="true"
                placeholder=" دسته والد را انتخاب کنید"
                name="parent_id"
                data-allow-clear="true"
            >
                @foreach($product_categories as $key=>$category)
                    @php
                        $isDisabled = shouldDisableCategory($product_categories, $category['id']);
                    @endphp

                    <option {{ $isDisabled ? 'disabled' : '' }}
                            @if(isset($data) && $category['id'] == $data['id']) disabled @endif
                            value="{{$category['id']}}"
                            @if(isset($data) && ($category['id'] == $data->parent_id || (old('parent_id') && $category['id'] == old('parent_id')))) selected @endif>
                        {{ $category['title'] }}
                    </option>

                @endforeach
            </select>
        </div>
        <div class="col-xxl-4 col-sm-6 p-2">
            <x-cms-image-input
                name="image"
                label="تصویر "
                :imageSrc="(isset($data) && $data->image) ? $data->getImage() : null"
                :deletable="true"
                :deleteUrl="'model='.\Rahweb\CmsCore\Modules\Product\Entities\ProductCategory::class.'&id='.@$data['id']"
                width="300"
                height="300"
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
                    label="نمایش در منو"
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
