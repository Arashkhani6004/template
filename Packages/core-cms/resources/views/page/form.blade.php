
            <div class="container-fluid">
                <div class="card-block row w-100 m-0">
                    <div class="col-xxl-3 col-sm-6 col-12 p-2">
                        <div class="form-group">
                            <x-cms-input
                                name="title"
                                label="عنوان"
                                :validations="['requiredCms']"
                                type="text"
                                :valueData="@$data"
                            />
                        </div>
                    </div>
                    <div class="col-xxl-3 col-sm-6 col-12 p-2">
                        <div class="form-group">
                            <x-cms-input
                                name="url"
                                label="آدرس url"
                                :validations="['requiredCms','urlCms']"
                                type="text"
                                :valueData="@$data"
                            />
                        </div>
                    </div>
                    <div class="col-xxl-3 col-sm-6 col-12 p-2">
                        <x-cms-select
                            name="parent_id"
                            label="دسته بندی"
                            :options="$page"
                            optionValue="id"
                            optionLabel="title"
                            :searchable="true"
                            :selectedOption="isset($data->parent_id) ? $data->parent_id : null"
                        />
                    </div>
                    <div class="col-xxl-3 col-sm-6 col-12 p-2">
                        <x-cms-image-input
                            name="image"
                            label="تصویر "
                            :imageSrc="(isset($data) && $data->image) ? $data->item_image : null"
                            :validations="['requiredCms']"

                        />
                    </div>

                    <div class="col-12 p-2">
                        <div class="form-group">
                            <x-cms-ck-editor
                                name="description"
                                label="توضیحات"
                                type="text"
                                :valueData="@$data"
                            />
                        </div>
                    </div>
                    <div class="col-12 p-2">
                        <div class="form-group">
                            <x-cms-check-box
                                name="show_in_first_page"
                                label="نمایش در صفحه اول"
                                :valueData="@$data"
                            />
                        </div>
                    </div>
                    <div class="w-100 pe-0">
                        <button type="submit" id="submitFormCms" class="btn btn-custom rounded-custom w-fit px-3 py-2">
                            ذخیره
                        </button>
                    </div>
                </div>
                </div>
            </div>
            @push('styles')
                <link rel="stylesheet" href="{{asset('assets/admin/css/233bootstrap-select.min.css')}}">
            @endpush
            @push('scripts')
                <script src="{{asset('assets/admin/js/833bootstrap-select.min.js')}}"></script>
                <script src="{{asset('assets/admin/ckeditor/ckeditor.js')}}"></script>
                <script>
                    setTimeout(function(){
                        var cks = document.getElementsByClassName('ckeditor4');
                        Array.from(cks).forEach((el) => {
                            CKEDITOR.replace("description", {
                                language: 'fa',
                                content: 'fa',
                                removeButtons: 'Font,FontSize,PasteFromWord',
                                filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
                                filebrowserUploadMethod: 'form'
                                on: {
                                    instanceReady: function(event) {
                                        event.editor._.forcePasteDialog = true;
                                        event.editor.on('key', function(evt) {
                                            if (evt.data.$.ctrlKey && evt.data.$.shiftKey && evt.data.dataKey === 86) { // 86 کد کلید V است
                                                evt.data.preventDefault();
                                                event.editor.execCommand('paste');
                                            }
                                        });
                                    }
                                }
                            });
                        });
                    },100);
                </script>
            @endpush
