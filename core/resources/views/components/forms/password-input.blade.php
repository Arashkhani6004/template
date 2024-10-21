<label for="{{$name}}">
    {{$label}}
    @if($validations && in_array("requiredCms",$validations))
        <span class="text-danger">*</span>
    @endif
</label>
<div class="position-relative">
    <input
        id="{{$name.'-'.$unique_id}}"
        name="{{$name}}"
        class="form-control bg-light rounded-custom"
        type="password"
    @foreach($pure_validations as $row)
        {{$row}}
    @endforeach
    @foreach($valuable_validations as $key=>$row)
        {{$key}}="{{$row}}"
    @endforeach
    placeholder="{{$label . ' را وارد کنید..'}}"
    />
    <div class="input-group-append position-absolute end-0 top-0 mt-2 d-flex align-items-center">
        <button class="btn" type="button" id="button{{$unique_id}}" onclick="togglePassword{{$unique_id}}(event)">
            <i class="bi bi-eye-slash d-flex" aria-hidden="true"></i>
        </button>
    </div>
</div>



@push('scripts')
    <script>
        function togglePassword{{$unique_id}}(e){
            const password = document.getElementById('{{$name.'-'.$unique_id}}');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // Toggle eye icon
            const toggleButton = document.getElementById('button{{$unique_id}}');
            toggleButton.innerHTML = '';
            if (type === 'password') {
                toggleButton.innerHTML = '<i class="bi bi-eye-slash d-flex" aria-hidden="true"></i>';
            } else {
                toggleButton.innerHTML = '<i class="bi bi-eye d-flex" aria-hidden="true" style="color:#7367f0"></i>';
            }
        }
    </script>
@endpush
