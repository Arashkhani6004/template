@push('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('assets/admin/cropper/cropper.css')}}">
    <style>
        .label { cursor: pointer; }
        .progress { display: none; margin-bottom: 1rem; }
        .alert { display: none; }
        .img-container { max-width: 300px;max-height: 300px;margin: auto;display: block; overflow: hidden; }
        .modal .modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - (1.75rem * 2));
        }
        .modal .modal-dialog-centered::before {
            content: '';
            display: block;
            height: calc(100vh - (1.75rem * 2));
            height: -webkit-min-content;
            height: -moz-min-content;
            height: min-content;
        }
        .cropper-view-box img {
            opacity: 0 !important;
        }
        .cropper-crop-box {
            background: rgba(250,250,250,0.2) !important;
        }
        .cropper-canvas{
            margin: auto !important;
            transform: unset !important;
        }
        .img-container img {
            max-width: 100%; /* برای نمایش بهتر تصویر */
        }
    </style>
@endpush
@php
    $unique_id = \Illuminate\Support\Str::random(10);
    $width = @$options['width'];
    $height = @$options['height'];
@endphp
<div class="d-flex col-md-6 col-12 my-2">
    <div class="p-1 w-100">
        <div class="form-group">
            <label>{{ @$data['p_name'] }}</label>
            <input type="file" class="form-control bg-light rounded-custom"
                   accept="image/*" id="image_input{{ $unique_id }}" data-unique-id="{{ $unique_id }}">
        </div>
    </div>
    @if(isset($data))
        <div id="data-image{{ $unique_id }}" style="display: block">
            <div class="image-container p-1 position-relative">
                <a href="{{ route('admin.common.remove-image', ['model' => \Rahweb\CmsCore\Modules\Setting\Entities\Setting::class, 'name' => 'value', 'id' => @$data['id']]) }}"
                   type="button" class="btn btn-danger btn-sm delete-image rounded-circle p-0 position-absolute"
                   style="top: 0; right: 0">
                    <i class="bi bi-x d-flex"></i></a>
                <img class="rounded shadow border img-gallery-thumb" style="background: #a49f9f;" src="{{ $data->image }}">
            </div>
        </div>
    @endif
    <div class="modal fade" id="modal{{ $unique_id }}" tabindex="-1" role="dialog" data-bs-backdrop='static' aria-labelledby="modalLabel{{ $unique_id }}" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel{{ $unique_id }}">انتخاب قسمت مورد نظر</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="image{{ $unique_id }}" src="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                    <button type="button" class="btn btn-primary" id="crop{{ $unique_id }}">بریدن</button>
                </div>
            </div>
        </div>
    </div>
    <div class="gallery flex-wrap" id="image_preview{{ $unique_id }}" style="display: none"></div>
    <input type="file" id="cropped_image_file{{ $unique_id }}" name="{{ @$data['type'] }}[{{ @$data['key'] }}]" class="d-none">
</div>


@push('scripts')
    <script src="{{ asset('assets/admin/cropper/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/cropper/cropper.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var input = document.getElementById('image_input{{ $unique_id }}');
            var image = document.getElementById('image{{ $unique_id }}');
            var croppedImageInput = document.getElementById('cropped_image_file{{ $unique_id }}');
            var $modal = $('#modal{{ $unique_id }}');
            var cropper;

            input.addEventListener('change', function (e) {
                var files = e.target.files;
                if (files && files.length > 0) {
                    var file = files[0];
                    var url = URL.createObjectURL(file);
                    image.src = url;
                    document.getElementById('data-image{{ $unique_id }}').style.display = 'none'; // Hide previous image
                    $modal.modal('show');
                }
            });

            $modal.on('shown.bs.modal', function () {
                cropper = new Cropper(image, {
                    aspectRatio: {{ $width }} / {{ $height }},
                    viewMode: 1,
                });
            }).on('hidden.bs.modal', function () {
                cropper.destroy();
                cropper = null;
            });

            document.getElementById('crop{{ $unique_id }}').addEventListener('click', function () {
                if (cropper) {
                    var canvas = cropper.getCroppedCanvas({
                        width: {{ $width }},
                        height: {{ $height }},
                    });

                    canvas.toBlob(function (blob) {
                        if (!blob) {
                            console.error('Canvas is empty');
                            return;
                        }

                        // Create a new File from the blob
                        var file = new File([blob], 'croppedImage.jpg', { type: 'image/jpeg' });

                        // Simulate user selection of file by assigning to input
                        var dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        croppedImageInput.files = dataTransfer.files;
                        console.log(croppedImageInput)
                        // Set the name attribute to match the desired format


                        // Optionally, display the cropped image preview
                        var url = URL.createObjectURL(blob);
                        document.getElementById('image_preview{{ $unique_id }}').style.display = 'block';
                        document.getElementById('image_preview{{ $unique_id }}').innerHTML = '<img src="' + url + '" class="img-thumbnail"/>';

                        $modal.modal('hide');
                    }, 'image/png');
                }
            });
        });
    </script>
@endpush





