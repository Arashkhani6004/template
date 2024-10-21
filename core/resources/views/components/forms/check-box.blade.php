<div class="form-check border border-custom2 w-fit rounded-custom  rounded-custom p-0 d-flex align-items-center">
    <input class="form-check-input my-2 ms-2"
           style="width: 30px; height: 30px;"
           id="{{$name}}"
           @if(isset($valueData))
               @if($valueData[$name] == 1)
                   checked="checked"
                   @endif

           @else
               @if($value == 1)
               checked="checked"
           @endif
           @endif
           value="1"
           name="{{$name}}"
           type="checkbox"
           role="switch">
        <label class="form-check-label p-2" for="{{$name}}">
            {{$label}}
            @if($validations && in_array("requiredCms",$validations)) <span class="text-danger">*</span> @endif
        </label>


    </div>
