<div class="col-xxl-3 col-sm-6 col-12 px-md-2 px-0 my-2">
<label>
{{$data['p_name']}}
</label>
    <select class="w-100 boot-select selectpicker" name="{{$data['key']}}" data-live-search="true"  placeholder="انتخاب کنید">
        @foreach(\Config::get('settings.color_types') as $key4 => $color_type)
            @php
                $colorData = json_decode($color_type, true);
            @endphp
            <option value="{{$color_type}}"
                    @if($data['value'] == $color_type) selected @endif
                    style="background: linear-gradient(90deg, {{ $colorData['color-body'] }} 0%, {{ $colorData['color-two'] }} 50%, {{ $colorData['color-one'] }} 100%);">
                {{$key4}}
            </option>
        @endforeach

</select>
</div>
@push('styles')
    <link rel="stylesheet" href="{{asset('assets/admin/css/233bootstrap-select.min.css')}}">
@endpush
@push('scripts')
    <script src="{{asset('assets/admin/js/833bootstrap-select.min.js')}}"></script>
@endpush
