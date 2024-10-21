
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
                        <x-cms-image-input
                            name="image"
                            label="تصویر "
                            :imageSrc="(isset($data) && $data->image) ? $data->getImage() : null"
                            :validations="['requiredCms']"
                            width="300"
                            height="300"
                             cropper="1"
                        />
                    </div>
                    <div class="col-12 p-2">
                        <div class="form-group">
                            <x-cms-check-box
                                name="show_in_first_page"
                                label="نمایش در صفحه اول"
                                :valueData="@$data"
                            />
                        </div>
                    </div>
                    <div class="w-100 pe-2">
                        <button type="submit" id="submitFormCms" class="btn btn-custom rounded-custom w-fit px-3 py-2">
                            ذخیره
                        </button>
                    </div>
                </div>
            </div>
