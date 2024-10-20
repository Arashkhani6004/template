<div class="row w-100 m-0 user-box">
    <div class="col-lg-12 col-md-1 col-sm-2 col-2 p-1 text-center">
        <div class="icon">
            <img src="{{\Illuminate\Support\Facades\Auth::user()->getDashboardAvatar()}}" width="35" class="m-auto d-flex">
        </div>
    </div>
    <div class="col-lg-12 col-md-11 col-sm-10 col-10 p-1">
        <div class="d-flex flex-column align-items-lg-center align-items-start">
            <p class="m-0 dynamic-color">
                {{\Illuminate\Support\Facades\Auth::user()->full_name}}
            </p>
            <p class="m-0 font-num-r dynamic-color">
                {{\Illuminate\Support\Facades\Auth::user()->mobile}}

            </p>
        </div>
    </div>
</div>
