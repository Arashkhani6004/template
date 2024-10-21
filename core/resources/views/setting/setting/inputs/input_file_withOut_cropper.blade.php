@php $unique_id = \Illuminate\Support\Str::random(10);
@endphp
<div class="d-flex col-md-6 col-12 my-2">
    <div class="p-1 w-100">
        <div class="form-group">
            <label>
                {{@$data['p_name']}}
            </label>
            <input type="file" class="form-control bg-light rounded-custom" name="{{@$data['type']}}[{{@$data['key']}}]"
                   accept="image/*" id="image_input{{$unique_id}}">
        </div>
    </div>
    @if(isset($data))
        <div id="data-image{{$unique_id}}" style="display: block">
            <div class="image-container p-1 position-relative">
                <a
                    href="{{route('admin.common.remove-image',['model'=>\Rahweb\CmsCore\Modules\Setting\Entities\Setting::class,'name'=>'value','id'=>@$data['id']])}}"
                    type="button" class="btn btn-danger btn-sm  delete-image rounded-circle p-0 position-absolute"
                    style="top: 0;right: 0"><i class="bi bi-x d-flex"></i></a>
                <img class="rounded shadow border img-gallery-thumb" style="background: #a49f9f;"  src="{{$data->image}}">
            </div>
        </div>
    @endif
    <div class="gallery flex-wrap" id="image_preview{{$unique_id}}" style="display: none"></div>
</div>

@push('scripts')
    <script>

        function removeFileFromFileList(index) {
            const dt = new DataTransfer()
            const input = document.getElementById('image_input{{$unique_id}}')
            const { files } = input
            for (let i = 0; i < files.length; i++) {
                const file = files[i]
                if (index !== i)
                    dt.items.add(file) // here you exclude the file. thus removing it.
            }
            input.files = dt.files // Assign the updates list
        }
        $(function () {

            var imagesPreview = function (input, placeToInsertImagePreview) {


                if (input.files) {
                    var files = Array.from(input.files);
                    files.map(function (file) {
                        var reader = new FileReader();
                        reader.onload = function (event) {
                            var deleteButton = $('<button type="button" class="btn btn-danger btn-sm  delete-image rounded-circle p-0 position-absolute" style="top: 0;right: 0"><i class="bi bi-x d-flex"></i></button>');
                            var imageContainer = $('<div class="image-container p-1 position-relative"></div>').append(
                                $($.parseHTML('<img>')).attr('src', event.target.result).addClass('img-gallery-thumb'),
                                deleteButton
                            );
                            imageContainer.appendTo(placeToInsertImagePreview);
                            deleteButton.on('click', function () {
                                removeFileFromFileList(0);
                                {{--console.log($('#image_input{{$unique_id}}'));--}}

                                $(this).closest('.image-container').remove();
                                if(document.querySelectorAll('.image-container').length === 0){
                                    $('#image_input{{$unique_id}}').val('');
                                }
                                @if(isset($data))
                                $('#data-image{{$unique_id}}').css('display', 'block');
                                @endif
                            });
                        }
                        reader.readAsDataURL(file);
                    });
                }
            };
            $('#image_input{{$unique_id}}').on('change', function () {
                if (this.files.length > 0) {
                    $('#image_preview{{$unique_id}}').empty();
                }
                imagesPreview(this, '#image_preview{{$unique_id}}');
                $('#image_preview{{$unique_id}}').css('display', 'flex');
                $('#data-image{{$unique_id}}').css('display', 'none');
            });
        });
    </script>
@endpush
