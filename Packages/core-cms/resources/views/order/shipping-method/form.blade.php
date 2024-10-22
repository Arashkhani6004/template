<div class="container-fluid">
    <div class="card-block row w-100 m-0">
        <div class="col-xxl-3 col-sm-3 col-12 p-2">
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
        <div class="col-xxl-3 col-sm-3 col-12 p-2">
            <div class="form-group">
                <x-cms-input
                    name="price"
                    label="قیمت (تومان) "
                    :validations="['requiredCms','numberCms']"
                    type="text"
                    :valueData="@$data"
                />
            </div>
        </div>
        <div class="col-xxl-4 col-sm-4 col-12 p-2">
            <div class="border p-1">
                <label for="cities" class="col-form-label">
                    انتخاب شهر :
                </label>
                <div class="bg-light p-3">
                    <div class="row w-100">
                        <div class="col-lg-6 p-2">
                            <div class="form-group">
                                <button type="button" onclick="selects()" class="btn btn-space btn-info m-0 px-5">انتخاب همه</button>
                            </div>
                        </div>
                        <div class="col-lg-6 p-2">
                            <div class="form-group">
                                <button type="button" onclick="deSelect()" class="btn btn-space btn-danger m-0 px-5">پاک کردن</button>
                            </div>
                        </div>
                    </div>
                    <input type="text" class="form-control mb-2" id="myInput" onkeyup="myFunction()" placeholder="جستجو ..">
                    <div class="sd-checkbox ">
                        <ul id="myUL" class="p-0 m-0" style="list-style-type:none">
                            @foreach($cities as $key=>$row2)
                                <li>
                                    <label class="custom-ch">
                                        {{$row2['name']}}
                                        <input type="checkbox" value="{{$row2['id']}}"
                                               @checked(@$data ? @$data->cities()->find( $row2->id ) : null)
                                               name="cities[]" class="form-control" multiple
                                        >
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-2 col-sm-2 col-12 p-2">
            <div class="form-group">
                <x-cms-check-box
                    name="status"
                    label="نمایش "
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
@push('styles')
    <link rel="stylesheet" href="{{asset('assets/admin/css/233bootstrap-select.min.css')}}">
@endpush
@push('scripts')
    <script src="{{asset('assets/admin/js/833bootstrap-select.min.js')}}"></script>
    <script type="text/javascript">
        function selects(){
            var ele=document.getElementsByName('cities[]');
            for(var i=0; i<ele.length; i++){
                if(ele[i].type=='checkbox')
                    ele[i].checked=true;
            }
        }
        function deSelect(){
            var ele=document.getElementsByName('cities[]');
            for(var i=0; i<ele.length; i++){
                if(ele[i].type=='checkbox')
                    ele[i].checked=false;

            }
        }

        function myFunction() {

            var input, filter, ul, li, la, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            ul = document.getElementById("myUL");
            li = ul.getElementsByTagName("li");


            for (i = 0; i < li.length; i++) {
                la = li[i].getElementsByTagName("label")[0];
                txtValue = la.textContent || la.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    </script>
@endpush
