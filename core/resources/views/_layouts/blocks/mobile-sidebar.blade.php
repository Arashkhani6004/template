<div
class="sidebar header bg-white px-0 py-3 border mt-lg-4 mt-md-3 mt-sm-2 mt-1 rounded-custom shadow d-lg-none d-block">
<div class="row w-100 m-0">
    <div class="col-3 text-center align-self-center p-2">
        <span
            style="font-size:30px;cursor: pointer;" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasderawer" aria-controls="offcanvasderawer">
            <i class="bi bi-list d-flex"></i>
        </span>
    </div>
        <div class="col-9 text-center align-self-center p-2">
            <div class="dashboard-header d-flex justify-content-end mb-md-0">
                <div class="v-avatar is-large">
                    <div class="dropdown">
                        <div class="d-flex align-items-center px-2">
                            <a class="d-flex text-decoration-none mx-2" href="{{url('admin/logout')}}" data-bs-toggle="tooltip" data-bs-title="خروج">
                                <i class="bi bi-power fs-4 d-flex color-custom ms-2"></i>
                            </a>
                            <a class="d-flex text-decoration-none mx-2" href="" data-bs-toggle="tooltip" data-bs-title="تنظیمات">
                                <i class="bi bi-gear fs-4 d-flex color-custom"></i>
                            </a>
                            <a class="d-flex text-decoration-none mx-2" href="" data-bs-toggle="tooltip" data-bs-title="داشبورد">
                                <i class="bi bi-speedometer2  fs-4 d-flex color-custom"></i>
                            </a>
                            <div class="dropdown dropdown-custom">
                                <div class="position-relative mx-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-bell fs-4 d-flex color-custom"></i>
                                    <i class="position-absolute small top-0 translate-middle bi bi-circle d-flex text-light rounded-circle fs-5" style="right: -20px; background-color:#ea5455;">
                                        <span class="position-absolute end-0 top-0 bottom-0 align-items-center d-flex justify-content-center" style="font-size:12px; right: 0 !important;">۲</span>
                                    </i>
                                </div>
                                <ul class="dropdown-menu p-2" id="drop-alert2">
                                    <li>
                                        <div class="dropdown-item d-flex align-items-center px-0">
                                            <div class="alert alert-dismissible fade show px-4  border rounded-custom" role="alert">
                                                <a href="" class="text-decoration-none w-100">
                                                    <ul class="d-sm-flex list-unstyled pe-1">
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
                                        <div class="dropdown-item d-flex align-items-center px-0">
                                            <div class="alert alert-dismissible fade show px-4  border rounded-custom" role="alert">
                                                <a href="" class="text-decoration-none w-100">
                                                    <ul class="d-sm-flex list-unstyled pe-1">
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

     {{--                                        for the last dropdown item the btn-close must have onclick="dropClose2()--}}
                                        <div class="dropdown-item d-flex align-items-center px-0">
                                            <div class="alert alert-dismissible fade show px-4 border rounded-custom" role="alert">
                                                <a href="" class="text-decoration-none w-100">
                                                    <ul class="d-sm-flex list-unstyled pe-1">
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
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="dropClose2()"></button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="dropdown dropdown-custom">
                                <div class="position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{asset('assets/admin/images/user2.webp')}}"
                                         class="border shadow me-2 rounded-circle" width="50" >
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
                                                    admin
                                                </small>
                                            </p>

                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-item d-flex align-items-center w-100 py-2">
                                            <a class="color-custom d-flex align-items-center"
                                               href="">
                                                <i class="bi bi-person-check h5 my-0 me-3 d-flex"></i>
                                                پروفایل من
                                            </a>
                                        </div>
                                    </li>
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
                        </div>
                    </div>
                </div>
            </div></div>
{{--    <div class="col-md-3 col-sm-5 col-6 text-center align-self-center p-2">--}}
{{--        <a class="text-danger d-flex align-items-center justify-content-end mx-3"--}}
{{--            href="{{url('admin/logout')}}">--}}
{{--            <i class="bi bi-power h5 my-0 me-2 d-flex"></i>--}}
{{--            خروج از حساب--}}
{{--        </a>--}}
{{--    </div>--}}
</div>
<div class="offcanvas offcanvas-end w-75" data-bs-scroll="true" tabindex="-1" id="offcanvasderawer"
    aria-labelledby="offcanvasderawerLabel">
    <div class="offcanvas-header d-flex align-items-center justify-content-between px-3 pb-0">
        <div class="xs p-0">
            <a href="/" target="_blank"
               class="mb-0 d-flex align-items-center justify-content-start me-2 p-0">
                <img src="{{asset('assets/admin/images/fav.png')}}" width="50px" height="50px"/>
                <span class="h6 fw-bold ms-2 mb-0" style="color:#5d596c;">
                 برورو
                    </span>
            </a>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body px-0">
        <div class="d-flex flex-column h-100">

            @include('CmsCore::_layouts.blocks.inner-sidebar')

        </div>
    </div>
</div>
</div>
