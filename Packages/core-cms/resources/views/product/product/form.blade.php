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
            <label for="categories">
                دسته بندی ها
            </label>
            <select
                id="categories"
                multiple
                class="w-100 boot-select selectpicker"
                data-live-search="true"
                placeholder=" دسته  را انتخاب کنید"
                name="categories[]"
            >
                @foreach($categories as $key=>$cat)
                    @php
                        $selected = isset($data) ?@$data->categories()->find($cat->id) : false;
                    @endphp
                    <option
                        @selected(old('categories') ? in_array($cat->id,old('categories')) : $selected)
                        {{ count($cat->children) > 0 ? 'disabled' : '' }} value="{{$cat['id']}}">
                        {{ $cat['title'] }}
                    </option>
                @endforeach
            </select>
        </div>
        @if(isset($data) && count($data->variants) > 0)
            <div role="alert" class="alert alert-info d-block">
              برای تغییر موجودی و قیمت محصولات با متغییر به
                <a href="{{route('admin.product-variant.index',['id'=>$data->id])}}">صفحه مربوطه</a>
                مراجعه کنید
            </div>
        @endif
        <div class="col-xxl-4 col-sm-6 p-2">
            <div class="form-group">
                <x-cms-input
                    name="price"
                    label="قیمت(تومان)"
                    :validations="['numberCms']"
                    :properties="isset($data) && count($data->variants)  > 0 ? ['readonly'] : []"
                    type="text"
                    :valueData="@$data"
                />
            </div>
        </div>
        <div class="col-xxl-4 col-sm-6 p-2">
            <div class="form-group">
                <x-cms-input
                    name="discounted_price"
                    label="قیمت با تخفیف(تومان)"
                    :validations="['numberCms']"
                    :properties="isset($data) && count($data->variants) > 0 ? ['readonly'] : []"
                    type="text"
                    :valueData="@$data"
                />
            </div>
        </div>
        <div class="col-xxl-4 col-sm-6 p-2">
            <div class="form-group">
                <x-cms-input
                    name="stock"
                    label="موجودی"
                    :validations="['numberCms']"
                    :properties="isset($data) && count($data->variants) > 0 ? ['readonly'] : []"
                    type="text"
                    :valueData="@$data"
                />
            </div>
        </div>
        <div class="col-xxl-6 col-sm-6 p-2">
            <x-cms-select
                name="brand_id"
                label=" برند"
                :options="$brand"
                optionValue="id"
                optionLabel="title"
                :searchable="true"
                :selectedOption="isset($data->brand_id) ? $data->brand_id : null"
            />
        </div>
        <div class="col-xxl-6 col-sm-6 p-2">
            <label for="categories">
                محصولات مرتبط
            </label>
            <select
                id="products"
                multiple
                class="w-100 boot-select selectpicker"
                data-live-search="true"
                placeholder=" محصولات  را انتخاب کنید"
                name="products[]"
            >
                @foreach($products as $key=>$row)
                    @php
                        $selected = isset($data) ? @$data->related()->find($row->id) : false;
                    @endphp
                    <option value="{{$row['id']}}"
                        @selected(old('products') ? in_array($row->id,old('products')) : $selected)
                        {{ (isset($data) && @$data->related()->find($row->id)) ? 'selected' : '' }}
                    >
                        {{ $row['title'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-xxl-12 col-sm-12 p-2">
            <label for="tags">
               تگ ها
            </label>
            <select
                id="tags"
                multiple
                class="w-100 boot-select selectpicker"
                data-live-search="true"
                placeholder="تگ را انتخاب کنید"
                name="tags[]"
            >
                @foreach($tags as $key=>$row)
                    @php
                        $selected = isset($data) ? @$data->tags()->find($row->id) : false;
                    @endphp
                    <option value="{{$row['id']}}"
                        @selected(old('tags') ? in_array($row->id,old('tags')) : $selected)
                        {{ (isset($data) && @$data->tags()->find($row->id)) ? 'selected' : '' }}
                    >
                        {{ $row['title'] }}
                    </option>
                @endforeach
            </select>
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
