
            <div class="container-fluid">
                <div class="card-block row w-100 m-0">
                    <div class="col-xxl-3 col-sm-6 col-12 p-2">
                        <div class="form-group">
                            <x-cms-input
                                name="link"
                                label="لینک"
                                :validations="['requiredCms']"
                                type="text"
                                :valueData="@$data"
                            />
                        </div>
                    </div>
                    <div class="col-xxl-3 col-sm-6 col-12 p-2">
                        <label>
                            نوع
                            <span class="text-danger">*</span>
                        </label>
                        <select name="icon" requiredCms  class="w-100 boot-select selectpicker" data-live-search="true" placeholder="انتخاب کنید">
                            <option value="tiktok" @if(isset($data) && $data->icon == 'tiktok') selected @endif>تیک تاک</option>
                            <option value="youtube" @if(isset($data) && $data->icon == 'youtube') selected @endif>یوتیوب</option>
                            <option value="linkedin" @if(isset($data) && $data->icon == 'linkedin') selected @endif>لینکداین</option>
                            <option value="facebook" @if(isset($data) && $data->icon == 'facebook') selected @endif>فیسبوک</option>
                            <option value="instagram" @if(isset($data) && $data->icon == 'instagram') selected @endif>اینستاگرام</option>
                            <option value="telegram" @if(isset($data) && $data->icon == 'telegram') selected @endif>تلگرام</option>


                        </select>
                    </div>
                    <div class="w-100 pe-2">
                        <button type="submit" id="submitFormCms" class="btn btn-custom rounded-custom w-fit px-3 py-2">
                            ذخیره
                        </button>
                    </div>
                </div>
            </div>
