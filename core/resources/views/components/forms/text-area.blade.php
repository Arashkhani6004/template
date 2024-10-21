<label class="text-start w-100 d-flex justify-content-start" for="{{$name}}">
    <span> {{$label}}</span>
    @if($validations && in_array("requiredCms",$validations))
        <span class="text-danger">*</span>
    @endif
</label>
<textarea id="{{$name}}"
          @foreach($validations as $row)
              {{$row}}
          @endforeach
          type="{{$type}}"
          class="form-control bg-light rounded-custom"
          name="{{$name}}" placeholder="{{$label . ' را وارد کنید..'}}">@if(isset($valueData) && $valueData){{$valueData[$name]}}@else{{old($name)}}@endif</textarea>




