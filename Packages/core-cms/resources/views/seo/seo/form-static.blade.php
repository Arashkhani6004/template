<div class="container-fluid">
    <div class="card-block row w-100 m-0">

            <div class="col-12 p-2">
                <div class="form-group">
                    <x-cms-input
                        name="title_seo"
                        label="عنوان سئو"
                        :validations="['requiredCms']"
                        type="text"
                        :valueData="@$data"
                    />
                </div>
            </div>
            <div class="col-12 p-2">
                <div class="form-group">
                    <div class="form-group">
                        <x-cms-text-area
                            name="description_seo"
                            label="توضیحات سئو"
                            :validations="['requiredCms']"
                            type="text"
                            :valueData="@$data"
                        />
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <div class="form-group">
                        <x-cms-check-box
                            name="noindex"
                            label="عدم انتشار در ابزارهای جستجو"
                            :valueData="@$data"
                        />
                    </div>
                </div>

            </div>

        <div class="col-xl-3 col-md-4 col-sm-6 col-12 ms-auto p-2">
            <button type="submit" id="submitFormCms" class="btn btn-custom rounded-custom w-fit px-3 py-2">
                ذخیره
            </button>
        </div>
    </div>
</div>
