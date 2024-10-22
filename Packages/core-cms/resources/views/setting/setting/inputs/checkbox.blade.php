<div class="form-check border border-custom2 w-fit rounded-custom  rounded-custom p-0 d-flex align-items-center">
    <input class="form-check-input my-2 ms-2"
           style="width: 30px; height: 30px;"
           value="1"
           id="{{@$data['type']}}[{{@$data['key']}}]"
           name="{{@$data['type']}}[{{@$data['key']}}]"
           type="checkbox"
           role="switch" @if(@$data['value'] == 1) checked @endif>
    <label class="form-check-label p-2" for="{{@$data['type']}}[{{@$data['key']}}]" >
        {{@$data['p_name']}}
    </label>


</div>
