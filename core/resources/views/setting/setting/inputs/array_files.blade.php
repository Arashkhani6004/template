<style>
    .img-gallery-thumb{
        width: 100px;
        height: 100px;
    }
    .gallery{
        max-width: 330px;
        width: max-content;
    }
</style>
{{--Review : تصاویر این قسمت باگ دارن و درست نمیان--}}
{{--Todo : set limit for pics--}}
{{--Todo : تغییر ساختار برای عکس--}}
<div class="w-100 m-0 row">
    <div class="p-1 col-md-6 col-12">
        <div class="form-group">
            <label for="">{{@$data['p_name']}}</label>
            <input type="file" class="form-control bg-light rounded-custom" name="{{@$data['type']}}[{{@$data['key']}}][]" multiple
            accept="image/*" id="imgInp" value="{{old('image')}}">
        </div>
    </div>
    <div class="col-md-6 col-12 p-1">
        @if(isset($data))
            <div id="data-image" style="display: block">
                @foreach($data->image_array as $image)
                <img class="rounded shadow border img-gallery-thumb" style="background: black;" src="{{$image}}">
                @endforeach
            </div>
        @endif

        <div class="gallery flex-wrap" id="gallery" style="display: none"></div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    function removeFileFromFileList(index) {
        const dt = new DataTransfer()
        const input = document.getElementById('imgInp')
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
                                $('#imgInp').val('');
                            }
                            @if(isset($data))
                            $('#data-image').css('display', 'block');
                            @endif
                        });
                    }
                    reader.readAsDataURL(file);
                });
            }
        };

        $('#imgInp').on('change', function () {
            // Clear existing images only if there are new images selected
            if (this.files.length > 0) {
                $('#gallery').empty();
            }

            imagesPreview(this, '#gallery');
            $('#gallery').css('display', 'flex');
            $('#data-image').css('display', 'none');
        });
    });

</script>
