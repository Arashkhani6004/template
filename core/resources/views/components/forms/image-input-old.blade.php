<div class="d-flex">
    <div class="p-1 w-100">
        <div class="form-group">
            <label>
                {{$label}}
                @if($validations && in_array("requiredCms",$validations))
                    <span class="text-danger">*</span>
                @endif
            </label>
            <input type="file" class="form-control bg-light rounded-custom" name="{{$name}}" accept="image/*" id="image_input{{$name.$unique_id}}" value="{{old($name)}}">
            <div class="position-relative">
                <img class="rounded w-25" id="avatar{{$unique_id}}" src="" alt="">
                <button type="button" class="btn btn-danger btn-sm delete-preview-image rounded-circle p-0 position-absolute" style="top: 5px; right: 5px; display: none;" id="delete_preview_image{{$unique_id}}">
                    <i class="bi bi-x d-flex"></i>
                </button>
            </div>
        </div>
    </div>
    @if($imageSrc)
        <div id="data-image{{$unique_id}}" style="display: block">
            <div class="image-container p-1 position-relative">
                @if($deletable)
                    <a href="{{route('admin.common.remove-image',$deleteUrl.'&name='.$name)}}" type="button"
                       class="btn btn-danger btn-sm delete-image rounded-circle p-0 position-absolute"
                       data-bs-toggle="tooltip" data-bs-title="حذف تصویر"
                       style="top: 0;right: 0">
                        <i class="bi bi-x d-flex"></i>
                    </a>
                @endif
                <img class="rounded shadow border img-gallery-thumb" src="{{$imageSrc}}">
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
