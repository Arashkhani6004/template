<div class="container-fluid">
    <div class="card-block row w-100 m-0">
        @foreach($bank_fields as $key => $bank_field)
        <div class="col-xxl-3 col-sm-6 p-2">
            <div class="form-group">
                <label for="">
                    {{@$bank_field['value']}}
                    <span class="text-danger">*</span>
                </label>
                <input requiredCms type="{{$bank_field['type']}}" class="form-control bg-light rounded-custom" name="{{$key}}" placeholder=""
                       value="{{@$data['config'] ? json_decode(@$data['config'],true)[$key] : null}}" >
            </div>
        </div>
        @endforeach

        <div class="col-lg-3 col-sm-6 col-12 p-2 mt-3">
            <div class="form-group">
                <x-cms-check-box
                    name="status"
                    label="نمایش "
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


