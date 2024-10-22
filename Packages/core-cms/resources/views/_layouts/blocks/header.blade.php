{{--@if(count(request()->segments()) > 1)--}}
<!-- Body: Header -->
<div class="header bg-white px-0 py-3 border mt-4 rounded-custom shadow d-lg-block d-none">
    <nav class="navbar p-md-0">
        <div class="container">
            <div class="dashboard-header d-flex justify-content-between mb-md-0">
                <div class="v-avatar is-large">
                    <div class="dropdown">
                        <div class="d-flex align-items-center px-2">
                            <div class="dropdown dropdown-custom">
                            <div class="position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{asset('assets/admin/images/user2.webp')}}"
                                     class="shadow me-2 rounded-circle" width="50" >
                                <i class="position-absolute bg-white rounded-circle small p-1 bottom-0 bi bi-circle-fill d-flex" style="right: 0; color:#28c76f;"></i>
                            </div>
                            <ul class="dropdown-menu p-2">
                                <li class="border-bottom">
                                    <div class="dropdown-item d-flex align-items-center">
                                        <div class="position-relative">
                                            <img src="{{asset('assets/admin/images/user2.webp')}}"
                                                 class="border shadow me-2 rounded-circle" width="50" >
                                            <i class="position-absolute bg-white rounded-circle small p-1 bottom-0 bi bi-circle-fill d-flex" style="right: 0; color:#28c76f;"></i>
                                        </div>
                                            <p class="ms-2 my-1 fw-bolder text-nowrap d-flex flex-column color-custom">
                                                {{Auth::user()->full_name}}
                                                <small class="my-1 opacity-50" style="font-size: 12px;">
                                                    {{Auth::user()->mobile ? Auth::user()->mobile : ""}}
                                                </small>
                                            </p>

                                    </div>
                                </li>
{{--                                <li>--}}
{{--                                    <div class="dropdown-item d-flex align-items-center w-100 py-2">--}}
{{--                                        <a class="color-custom d-flex align-items-center"--}}
{{--                                           href="">--}}
{{--                                            <i class="bi bi-person-check h5 my-0 me-3 d-flex"></i>--}}
{{--                                           پروفایل من--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
                                <li>
                                                <div class="dropdown-item d-flex align-items-center w-100 py-2">
                                                    <a class="color-custom d-flex align-items-center"
                                                        href="{{url('admin/logout')}}">
                                                        <i class="bi bi-power h5 my-0 me-3 d-flex"></i>
                                                        خروج از حساب
                                                    </a>
                                                </div>
                                </li>
                            </ul>
                            </div>

                            <div class="dropdown dropdown-custom">
                                <div class="position-relative mx-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-bell fs-4 d-flex color-custom"></i>
                                    <i class="position-absolute small top-0 translate-middle bi bi-circle d-flex text-light rounded-circle fs-5" style="right: -20px; background-color:#ea5455;">
                                        <span class="position-absolute end-0 top-0 bottom-0 align-items-center d-flex justify-content-center" style="font-size:12px; right: 0 !important;">۲</span>
                                    </i>
                                </div>
                                <ul class="dropdown-menu p-2" id="drop-alert">
                                    <li>
                                        <div class="dropdown-item d-flex align-items-center">
                                                <div class="alert alert-dismissible fade show px-4  border rounded-custom" role="alert">
                                                    <a href="" class="text-decoration-none w-100">
                                                    <ul class="d-flex list-unstyled pe-4">
                                                        <li>
                                                            <img src="{{asset('assets/admin/images/user2.webp')}}"
                                                                 class="shadow me-2 rounded-circle" width="50" >
                                                        </li>
                                                        <li>
                                                            <p class="d-flex flex-column">
                                                                <span class="fw-bold">سفارش جدید</span>
                                                                سفارش جدید برای دوره ی میکروبلیدینگ ثبت شد.
                                                                <span class="small opacity-75">۱ ساعت قبل</span>
                                                            </p>
                                                        </li>
                                                    </ul>
                                                    </a>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-item d-flex align-items-center">
                                                <div class="alert alert-dismissible fade show px-4  border rounded-custom" role="alert">
                                                    <a href="" class="text-decoration-none w-100">
                                                    <ul class="d-flex list-unstyled pe-4">
                                                        <li>
                                                            <img src="{{asset('assets/admin/images/user2.webp')}}"
                                                                 class="shadow me-2 rounded-circle" width="50" >
                                                        </li>
                                                        <li>
                                                            <p class="d-flex flex-column">
                                                                <span class="fw-bold">سفارش جدید</span>
                                                                سفارش جدید برای دوره ی میکروبلیدینگ ثبت شد.
                                                                <span class="small opacity-75">۱ ساعت قبل</span>
                                                            </p>
                                                        </li>
                                                    </ul>
                                                    </a>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                        </div>
                                    </li>
                                    <li>
{{--                                        for the last dropdown item the btn-close must have onclick="dropClose()--}}
                                        <div class="dropdown-item d-flex align-items-center">
                                                <div class="alert alert-dismissible fade show px-4 border rounded-custom" role="alert">
                                                    <a href="" class="text-decoration-none w-100">
                                                    <ul class="d-flex list-unstyled pe-4">
                                                        <li>
                                                            <img src="{{asset('assets/admin/images/user2.webp')}}"
                                                                 class="border shadow me-2 rounded-circle" width="50" >
                                                        </li>
                                                        <li>
                                                            <p class="d-flex flex-column">
                                                                <span class="fw-bold">سفارش جدید</span>
                                                                سفارش جدید برای دوره ی میکروبلیدینگ ثبت شد.
                                                                <span class="small opacity-75">۱ ساعت قبل</span>
                                                            </p>
                                                        </li>
                                                    </ul>
                                                    </a>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="dropClose()"></button>
                                                </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <a class="d-flex text-decoration-none mx-2" href="{{url('/admin')}}" data-bs-toggle="tooltip" data-bs-title="داشبورد">
                                <i class="bi bi-speedometer2  fs-4 d-flex color-custom"></i>
                            </a>
                            <a class="d-flex text-decoration-none mx-2" href="{{url('admin/setting')}}" data-bs-toggle="tooltip" data-bs-title="تنظیمات" >
                                <i class="bi bi-gear fs-4 d-flex color-custom"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="d-flex text-decoration-none" href="{{url('admin/logout')}}" data-bs-toggle="tooltip" data-bs-title="خروج">
                <i class="bi bi-power fs-4 d-flex color-custom ms-2"></i>
            </a>

        </div>
    </nav>
</div>
{{--@include('CmsCore::_layouts.blocks.mobile-sidebar')--}}
{{--@else--}}
{{--<div class="px-2 py-2 mt-2 headsc">--}}
{{--    <div class="dashboard-pro">--}}
{{--        <div class="col-12 mx-auto px-md-5 px-1">--}}
{{--            <div class="row w-100 m-0">--}}
{{--                <div class="col-xxl-11 col-sm-10 col-9 ms-auto p-2">--}}
{{--                    <div class="row w-100 m-0">--}}
{{--                        <div class="col-sm-6 col-12 align-self-end p-0">--}}
{{--                            <p class="fw-bolder text-dark h5 mb-0 d-flex align-items-center">--}}
{{--                                <i class="bi bi-person-square h5 my-0 me-2 d-flex align-items-center"></i>--}}
{{--                                {{Auth::user()->full_name}}--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-6 d-sm-block d-none align-self-end p-0">--}}
{{--                            <ul class="p-0 m-0 d-flex align-items-center justify-content-end">--}}

{{--                                <li class="list-unstyled ms-2">--}}
{{--                                    <a class="btn btn-sm btn-logout px-1 d-flex align-items-center ms-auto"--}}
{{--                                        style="width: max-content;"--}}
{{--                                        href="{{url('admin/logout')}}">--}}
{{--                                        <i class="bi bi-power h5 my-0 me-1 d-flex"></i>--}}
{{--                                        خروج--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-12 mx-auto px-md-5 px-1">--}}
{{--        <div class="row w-100 m-0">--}}
{{--            <div class="col-xxl-1 col-sm-2 col-3 p-2">--}}
{{--                <div class="avatarr">--}}
{{--                    <img src="{{asset('assets/admin/images/user2.webp')}}"--}}
{{--                        alt="avatar" title="avatar" class="text-center" width="100%"--}}
{{--                        height="auto" />--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-xxl-11 col-sm-10 col-9 p-2">--}}
{{--                <div class="row w-100 m-0">--}}
{{--                    <div class="col-sm-6 col-12 align-self-start p-0">--}}
{{--                        <p class="text-custom m-0 h6 d-flex align-items-center">--}}
{{--                            <i class="bi bi-briefcase-fill h5 my-0 me-2 d-flex align-items-center"></i>--}}
{{--                            @php--}}
{{--                                $user = Rahweb\CmsCore\Modules\User\Entities\User::find(Auth::user()->id);--}}
{{--                            @endphp--}}
{{--                            @foreach ($user->roles as $role)--}}
{{--                            {{$role->name}}--}}
{{--                            @endforeach--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endif--}}
