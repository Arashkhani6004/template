<style>
    .input-read:read-only{
        background: #d2d2d2 !important;
    }
</style>
<div class="col-xxl-9 p-2 mx-auto">
    <div class="form-group">
        <label for="">{{@$data['p_name']}}</label><br>
        {{-- Review : validate hours --}}
        @foreach(Config::get('settings.days') as $key=>$value)
            <div class="w-100 m-0 row d-flex align-items-center py-3 border-bottom justify-content-between">
                <div class="col-xl-1 col-sm-2 col-6 px-1 my-1">
                    <label>{{@$value}}</label>

                </div>
                <div class="col-md-3 col-sm-4 col-6 px-1 my-1 d-flex justify-content-end justify-content-sm-start">
                    <div class="form-check form-switch">
                        <input class="form-check-input" @if(json_decode(@$data['value'], true)[$value]['from'] == null && json_decode(@$data['value'], true)[$value]['to'] == null) checked="checked" @endif value="1" type="checkbox" role="switch" id="offday{{@$key}}" oninput="checkOff('{{@$key}}')">
                        <label class="form-check-label" for="offday{{@$key}}"> تعطیل</label>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-3 col-6 d-flex align-items-center px-1 my-1">
                    <label class="d-flex me-2" for="">از</label>
                    <input requiredCms type="text" class="form-control bg-light rounded-custom d-flex input-read" name="{{@$data['key']}}[{{@$value}}][from]" placeholder="" value="{{json_decode(@$data['value'], true)[$value]['from']}}" id="fromInput{{@$key}}" readonly
                    onchange="checkHour(event)"
                    >
                </div>
                <div class="col-xl-4 col-sm-3 col-6 d-flex align-items-center px-1 my-1">
                    <label class="d-flex me-2" for="">تا</label>
                    <input requiredCms type="text" class="form-control bg-light rounded-custom d-flex input-read" name="{{@$data['key']}}[{{@$value}}][to]" placeholder="" value="{{json_decode(@$data['value'], true)[$value]['to']}}" id="toInput{{@$key}}" readonly
                           onchange="checkHour(event)"
                    >

                </div>
            </div>

          @endforeach

    </div>
</div>

@push('scripts')
    <script>
        window.onload = function (){
            @foreach(Config::get('settings.days') as $key=>$value)
            checkOff({{$key}})
            @endforeach
        }
        async function checkOff(key) {
            var fromInput = document.getElementById('fromInput' + key);
            var toInput = document.getElementById('toInput' + key);
            var checkbox = document.getElementById('offday' + key);

            if (checkbox.checked) {
                fromInput.readOnly = true;
                toInput.readOnly = true;
            } else {
                fromInput.readOnly = false;
                toInput.readOnly = false;
            }
        }
        async function checkHour(e){
            const hour = e.target.value;
            if (hour < 0 || hour > 24){
                Swal.fire({
                    icon: 'error',
                    text: "ساعت وارد شده نا معتبر است",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000
                });
                e.target.value = '';
                return false
            }
        }

    </script>
@endpush
