<div class="col-lg-4 col-12 p-1 py-lg-0 py-1">
    <div class="box-dash shadow-sm">
        <div class="icon dynamic-color">
            <i class="bi bi-info-square d-flex fs-3"></i>
        </div>
        <p class="font-md m-0 mt-2">
            اطلاعات کاربری
        </p>
        <ul class="p-0 m-0 mt-2">
            <li class="list-unstyled my-1 d-flex align-items-center justify-content-between">
                <p class="m-0 font-th">نام : <span class="font-md"> {{\Illuminate\Support\Facades\Auth::user()->full_name}}</span></p>
            </li>
            <li class="list-unstyled my-1 d-flex align-items-center justify-content-between">
                <p class="m-0 font-th"> شماره تماس : <span class="font-num fw-bolder"> {{\Illuminate\Support\Facades\Auth::user()->mobile}}</span></p>
            </li>
        </ul>
        <a href="{{route('panel.profile')}}" class="edit-info">
            <i class="bi bi-pencil-square d-flex fs-5"></i>
        </a>
    </div>
</div>
<div class="col-lg-4 col-12 p-1 py-lg-0 py-1">
    <div class="box-dash shadow-sm">
        <div class="icon dynamic-color">
            <i class="bi bi-handbag d-flex fs-3"></i>
        </div>
        <p class="font-md m-0 mt-2">
            سفارشات
        </p>
        <ul class="p-0 m-0 mt-2">
            <li class="list-unstyled my-1 d-flex align-items-center justify-content-between">
                <p class="m-0 font-md">{{count($user->orders)}}<span class="font-th ms-1">سفارش</span></p>
            </li>
            <li class="list-unstyled my-1 d-flex align-items-center justify-content-between">
                <a href="{{route('panel.orders')}}" class="d-flex align-items-center font-re text-dark">
                    مشاهده همه
                    <i class="bi bi-arrow-left-short d-flex"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
{{--<div class="col-lg-4 col-12 p-1 py-lg-0 py-1">--}}
{{--    <div class="box-dash shadow-sm">--}}
{{--        <div class="icon dynamic-color">--}}
{{--            <i class="bi bi-mailbox d-flex fs-3"></i>--}}
{{--        </div>--}}
{{--        <p class="font-md m-0 mt-2">--}}
{{--            تیکت ها--}}
{{--        </p>--}}
{{--        <ul class="p-0 m-0 mt-2">--}}
{{--            <li class="list-unstyled my-1 d-flex align-items-center justify-content-between">--}}
{{--                <p class="m-0 font-md">0<span class="font-th ms-1">تیکت</span></p>--}}
{{--            </li>--}}
{{--            <li class="list-unstyled my-1 d-flex align-items-center justify-content-between">--}}
{{--                <a href="#" class="d-flex align-items-center font-re text-dark">--}}
{{--                    مشاهده همه--}}
{{--                    <i class="bi bi-arrow-left-short d-flex"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--</div>--}}
