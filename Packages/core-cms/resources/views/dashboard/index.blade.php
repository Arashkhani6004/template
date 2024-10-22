@extends('CmsCore::_layouts.master')
@section('title','داشبورد')
@section('content')
<div class="body d-flex py-3">
    <div class="px-md-5 px-1 py-md-3 py-2">
        <div class="container text-center">
            <div class="row w-100 m-0 px-0 dash-content">
                <div class="w-100  d-flex align-items-center justify-content-between mb-2">
                    <p class="text-start fs-5 text-nowrap me-2 mb-0" style="color: #6f6b7d">
                        دسترسی سریع
                    </p>
                    <hr class="w-100 ">
                </div>
                {{-- <div class="col-xl-3 col-lg-4 col-sm-4 col-6 p-md-2 p-1">--}}
                    {{-- <a href="{{url('admin/admin')}}" --}} {{--
                        class="dashbtn d-flex align-items-center justify-content-between">--}}
                        {{-- <i class="bi bi-people d-flex "></i>--}}
                        {{-- مدیران سایت--}}
                        {{-- </a>--}}
                    {{-- </div>--}}
                {{-- <div class="col-xl-3 col-lg-4 col-sm-4 col-6 p-md-2 p-1">--}}
                    {{-- <a href="{{url('admin/users')}}" --}} {{--
                        class="dashbtn d-flex align-items-center justify-content-between">--}}
                        {{-- <i class="bi bi-people d-flex "></i>--}}
                        {{-- مدیریت کاربران--}}
                        {{-- </a>--}}
                    {{-- </div>--}}
                {{-- <div class="col-xl-3 col-lg-4 col-sm-4 col-6 p-md-2 p-1">--}}
                    {{-- <a href="{{url('admin/permission')}}" --}} {{--
                        class="dashbtn d-flex align-items-center justify-content-between">--}}
                        {{-- <i class="bi bi-laptop d-flex "></i>--}}
                        {{-- سطح دسترسی--}}
                        {{-- --}}{{-- <span class="bg-custom badge ms-2">--}}
                            {{-- --}}{{-- 0--}}
                            {{-- --}}{{-- </span>--}}
                        {{-- </a>--}}
                    {{-- </div>--}}
                {{-- <div class="col-xl-3 col-lg-4 col-sm-4 col-6 p-md-2 p-1">--}}
                    {{-- <a href="{{url('admin/gallery-category')}}" --}} {{--
                        class="dashbtn d-flex align-items-center justify-content-between">--}}
                        {{-- <i class="bi bi-card-image d-flex "></i>--}}
                        {{-- دسته بندی تصاویر--}}
                        {{-- </a>--}}
                    {{-- </div>--}}

                <div class="dash-box col-xxl-2 col-lg-3 col-sm-4 col-6 p-md-2 p-1">
                    <a href="{{url('admin/gallery')}}"
                        class="dashbtn d-flex align-items-center justify-content-between p-3">
                        تصاویر
                        <i class=" p-2 rounded bi bi-card-image d-flex "></i>
                    </a>
                </div>
                <div class="dash-box col-xxl-2 col-lg-3 col-sm-4 col-6 p-md-2 p-1">
                    <a href="{{url('admin/service')}}"
                        class="dashbtn d-flex align-items-center justify-content-between p-3">
                        خدمات
                        <i class="p-2 rounded bi bi-calendar3-event d-flex "></i>

                    </a>
                </div>
                {{-- <div class="col-xl-3 col-lg-4 col-sm-4 col-6 p-md-2 p-1">--}}
                    {{-- <a href="{{url('admin/blog-category')}}" --}} {{--
                        class="dashbtn d-flex align-items-center justify-content-between">--}}
                        {{-- <i class="bi bi-files d-flex "></i>--}}
                        {{-- دسته بندی مطالب--}}
                        {{-- </a>--}}
                    {{-- </div>--}}
                <div class="dash-box col-xxl-2 col-lg-3 col-sm-4 col-6 p-md-2 p-1">
                    <a href="{{url('admin/blog')}}"
                        class="dashbtn d-flex align-items-center justify-content-between p-3">
                        مطالب
                        <i class="p-2 rounded bi bi-files d-flex "></i>

                    </a>
                </div>
                <div class="dash-box col-xxl-2 col-lg-3 col-sm-4 col-6 p-md-2 p-1">
                    <a href="{{url('admin/worksample')}}"
                        class="dashbtn d-flex align-items-center justify-content-between p-3">
                        نمونه کارها
                        <i class="p-2 rounded bi bi-images d-flex "></i>

                    </a>
                </div>
                {{-- <div class="col-xl-3 col-lg-4 col-sm-4 col-6 p-md-2 p-1">--}}
                    {{-- <a href="{{url('admin/fee')}}" --}} {{--
                        class="dashbtn d-flex align-items-center justify-content-between">--}}
                        {{-- <i class="bi bi-hdd-stack d-flex "></i>--}}
                        {{-- نرخ ها--}}
                        {{-- </a>--}}
                    {{-- </div>--}}
                {{-- <div class="col-xl-3 col-lg-4 col-sm-4 col-6 p-md-2 p-1">--}}
                    {{-- <a href="{{url('admin/certificate')}}" --}} {{--
                        class="dashbtn d-flex align-items-center justify-content-between">--}}
                        {{-- <i class="bi bi-intersect d-flex "></i>--}}
                        {{-- گواهی نامه ها--}}
                        {{-- </a>--}}
                    {{-- </div>--}}
                <div class="dash-box col-xxl-2 col-lg-3 col-sm-4 col-6 p-md-2 p-1">
                    <a href="{{url('admin/package')}}"
                        class="dashbtn d-flex align-items-center justify-content-between p-3">
                        پکیج ها
                        <i class="p-2 rounded bi bi-card-text d-flex "></i>

                    </a>
                </div>
                {{-- <div class="col-xl-3 col-lg-4 col-sm-4 col-6 p-md-2 p-1">--}}
                    {{-- <a href="{{url('admin/banner')}}" --}} {{--
                        class="dashbtn d-flex align-items-center justify-content-between">--}}
                        {{-- <i class="bi bi-back d-flex "></i>--}}
                        {{-- اسلایدر ها (بنر ها)--}}
                        {{-- </a>--}}
                    {{-- </div>--}}
                {{-- <div class="col-xl-3 col-lg-4 col-sm-4 col-6 p-md-2 p-1">--}}
                    {{-- <a href="{{url('admin/page')}}" --}} {{--
                        class="dashbtn d-flex align-items-center justify-content-between">--}}
                        {{-- <i class="bi bi-book d-flex "></i>--}}
                        {{-- صفحات--}}
                        {{-- </a>--}}
                    {{-- </div>--}}
                <div class="dash-box col-xxl-2 col-lg-3 col-sm-4 col-6 p-md-2 p-1">
                    <a href="{{url('admin/branch')}}"
                        class="dashbtn d-flex align-items-center justify-content-between p-3">
                        شعب
                        <span class="d-flex align-items-center">
                            ۲
                            <i class="p-2 rounded bi bi-map d-flex ms-2"></i>
                        </span>

                    </a>
                </div>
                {{-- <div class="col-xl-3 col-lg-4 col-sm-4 col-6 p-md-2 p-1">--}}
                    {{-- <a href="{{url('admin/social')}}" --}} {{--
                        class="dashbtn d-flex align-items-center justify-content-between">--}}
                        {{-- <i class="bi bi-phone d-flex "></i>--}}
                        {{-- شبکه های اجتماعی--}}
                        {{-- </a>--}}
                    {{-- </div>--}}
                {{-- <div class="col-xl-3 col-lg-4 col-sm-4 col-6 p-md-2 p-1">--}}
                    {{-- <a href="{{url('admin/setting')}}" --}} {{--
                        class="dashbtn d-flex align-items-center justify-content-between">--}}
                        {{-- <i class="bi bi-gear d-flex "></i>--}}
                        {{-- تنظیمات--}}
                        {{-- </a>--}}
                    {{-- </div>--}}
            </div>
            {{-- <div class="row w-100 m-0 px-0 dash-content my-lg-5 my-4" style="filter: blur(3px);">--}}
                {{-- <div class="w-100  d-flex align-items-center justify-content-between mb-2">--}}
                    {{-- <p class="text-start fs-5 text-nowrap me-2 mb-0" style="color: #6f6b7d">--}}
                        {{-- تعداد هنرجویان هر دوره--}}
                        {{-- </p>--}}
                    {{--
                    <hr class="w-100 ">--}}
                    {{--
                </div>--}}

                {{-- <div class="dash-box mx-auto col-xl-4 col-sm-6 p-md-2 p-1">--}}
                    {{-- <div class="dashbtn d-flex align-items-center justify-content-between p-3">--}}
                        {{-- number of students is more than 150--}}
                        {{-- <div>--}}
                            {{-- <div class="position-relative">--}}
                                {{-- <img src="{{asset('assets/admin/images/avatar1.webp')}}" alt="avatar"
                                    title="avatar" width="30px" height="30px"
                                    class="position-absolute start-0 top-0 bottom-0 rounded-circle opacity-75">--}}
                                {{-- <img src="{{asset('assets/admin/images/avatar2.webp')}}" alt="avatar"
                                    title="avatar" width="30px" height="30px"
                                    class="position-absolute top-0 bottom-0 rounded-circle opacity-75"
                                    style="right:20px;">--}}
                                {{-- <img src="{{asset('assets/admin/images/avatar3.webp')}}" alt="avatar"
                                    title="avatar" width="30px" height="30px"
                                    class="position-absolute top-0 bottom-0 rounded-circle opacity-75"
                                    style="right:40px;">--}}
                                {{-- <img src="{{asset('assets/admin/images/avatar4.webp')}}" alt="avatar"
                                    title="avatar" width="30px" height="30px"
                                    class="position-absolute top-0 bottom-0 rounded-circle opacity-75"
                                    style="right:60px;">--}}
                                {{-- </div>--}}
                            {{-- <p class="fs-4 d-flex align-items-center pt-1" style="margin-right: 90px">--}}
                                {{-- <i class="bi bi-plus bg-transparent d-flex me-2" style="color:#9f9f9f"></i>--}}
                                {{-- ۱۵۵--}}
                                {{-- <span class="ms-1" style="font-size: 14px;">نفر</span>--}}
                                {{-- </p>--}}
                            {{-- <p class="m-0 fw-bold">--}}
                                {{-- میکروبلیدینگ--}}
                                {{-- </p>--}}
                            {{-- </div>--}}
                        {{-- end--}}
                        {{-- <i class="p-2 rounded bi bi-mortarboard d-flex me-2 fs-3"></i>--}}

                        {{-- </div>--}}
                    {{-- </div>--}}
                {{-- <div class="dash-box mx-auto col-xl-4 col-sm-6 p-md-2 p-1">--}}
                    {{-- <div class="dashbtn d-flex align-items-center justify-content-between p-3">--}}
                        {{-- --}}{{-- number of students is between 100 and 150--}}
                        {{-- <div>--}}
                            {{-- <div class="position-relative">--}}
                                {{-- <img src="{{asset('assets/admin/images/avatar1.webp')}}" alt="avatar"
                                    title="avatar" width="30px" height="30px"
                                    class="position-absolute start-0 top-0 bottom-0 rounded-circle opacity-75">--}}
                                {{-- <img src="{{asset('assets/admin/images/avatar2.webp')}}" alt="avatar"
                                    title="avatar" width="30px" height="30px"
                                    class="position-absolute top-0 bottom-0 rounded-circle opacity-75"
                                    style="right:20px;">--}}
                                {{-- <img src="{{asset('assets/admin/images/avatar3.webp')}}" alt="avatar"
                                    title="avatar" width="30px" height="30px"
                                    class="position-absolute top-0 bottom-0 rounded-circle opacity-75"
                                    style="right:40px;">--}}
                                {{-- </div>--}}
                            {{-- <p class="fs-4 d-flex align-items-center pt-1" style="margin-right: 70px">--}}
                                {{-- <i class="bi bi-plus bg-transparent d-flex me-2" style="color:#9f9f9f"></i>--}}
                                {{-- ۱۰۲--}}
                                {{-- <span class="ms-1" style="font-size: 14px;">نفر</span>--}}
                                {{-- </p>--}}
                            {{-- <p class="m-0 fw-bold">--}}
                                {{-- کانتورینگ--}}
                                {{-- </p>--}}
                            {{-- </div>--}}
                        {{-- --}}{{-- end--}}
                        {{-- <i class="p-2 rounded bi bi-mortarboard d-flex me-2 fs-3"></i>--}}

                        {{-- </div>--}}
                    {{-- </div>--}}
                {{-- <div class="dash-box mx-auto col-xl-4 col-sm-6 p-md-2 p-1">--}}
                    {{-- <div class="dashbtn d-flex align-items-center justify-content-between p-3">--}}
                        {{-- --}}{{-- number of students is less than 100--}}
                        {{-- <div>--}}
                            {{-- <div class="position-relative">--}}
                                {{-- <img src="{{asset('assets/admin/images/avatar1.webp')}}" alt="avatar"
                                    title="avatar" width="30px" height="30px"
                                    class="position-absolute start-0 top-0 bottom-0 rounded-circle opacity-75">--}}
                                {{-- <img src="{{asset('assets/admin/images/avatar2.webp')}}" alt="avatar"
                                    title="avatar" width="30px" height="30px"
                                    class="position-absolute top-0 bottom-0 rounded-circle opacity-75"
                                    style="right:20px;">--}}
                                {{-- </div>--}}
                            {{-- <p class="fs-4 d-flex align-items-center pt-1" style="margin-right: 50px">--}}
                                {{-- <i class="bi bi-plus bg-transparent d-flex me-2" style="color:#9f9f9f"></i>--}}
                                {{-- ۵۷--}}
                                {{-- <span class="ms-1" style="font-size: 14px;">نفر</span>--}}
                                {{-- </p>--}}
                            {{-- <p class="m-0 fw-bold">--}}
                                {{-- شیدینگ--}}
                                {{-- </p>--}}
                            {{-- </div>--}}
                        {{-- end--}}
                        {{-- <i class="p-2 rounded bi bi-mortarboard d-flex me-2 fs-3"></i>--}}

                        {{-- </div>--}}
                    {{-- </div>--}}
                {{-- </div>--}}
            {{-- <div class="row w-100 m-0 px-0" style="filter: blur(3px);">--}}
                {{-- <div class="w-100  d-flex align-items-center justify-content-between mb-2">--}}
                    {{-- <p class="text-start fs-5 text-nowrap me-2 mb-0" style="color: #6f6b7d">--}}
                        {{-- آمار فروش--}}
                        {{-- </p>--}}
                    {{--
                    <hr class="w-100 ">--}}
                    {{--
                </div>--}}
                {{-- <div class="col-sm-6 col-12 p-md-2 p-1">--}}
                    {{-- <div class="chart-box">--}}
                        {{-- <div class="title text-start">--}}
                            {{-- <p class="mb-2 d-flex align-items-center">--}}
                                {{-- <i class="p-2 rounded bi bi-graph-up d-flex me-2"
                                    style="color:#7367f0; background-color: #eae8fd;"></i>--}}
                                {{-- میانیگن مبلغ فروش دوره ها</p>--}}
                            {{-- <p class="small mb-2">یک ماه گذشته</p>--}}
                            {{-- <p>۱۰,۵۰۰,۰۰۰--}}
                                {{-- <span class="small opacity-75">--}}
                                    {{-- تومان--}}
                                    {{-- </span>--}}
                                {{-- </p>--}}
                            {{-- </div>--}}
                        {{-- <canvas id="myChart" style="width:100%;"></canvas>--}}
                        {{-- </div>--}}
                    {{-- </div>--}}
                {{-- <div class="col-sm-6 col-12 p-md-2 p-1">--}}
                    {{-- <div class="chart-box">--}}
                        {{-- <div class="title text-start">--}}
                            {{-- <p class="mb-2 d-flex align-items-center">--}}
                                {{-- <i class="p-2 rounded bi bi-graph-up d-flex me-2"
                                    style="color:#00cfe8; background-color: #d9f8fc;"></i>--}}
                                {{-- میانیگن مبلغ فروش دوره ها</p>--}}
                            {{-- <p class="small mb-2">یک ماه گذشته</p>--}}
                            {{-- <p>۱۰,۵۰۰,۰۰۰--}}
                                {{-- <span class="small opacity-75">--}}
                                    {{-- تومان--}}
                                    {{-- </span>--}}
                                {{-- </p>--}}
                            {{-- </div>--}}
                        {{-- <canvas id="myChart2" style="width:100%;"></canvas>--}}
                        {{-- </div>--}}
                    {{-- </div>--}}
                {{-- </div>--}}
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('assets/admin/js/chart.js')}}"></script>
<script>
    const xValues = [0, 5, 10, 15, 20, 25, 30];
    const yValues = [0, 2000000, 1500000, 2500000, 1000000, 3500000, 3000000];
    const myChart = new Chart("myChart", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                // Specify gradient using Chart.js's helper function:
                backgroundColor: "rgba(115,103,240,0.42)",
                borderColor: "#7367f0",
                data: yValues
            }]
        },
        options: {
            legend: { display: false }
        }
    });

    const xValues2 = [0, 5, 10, 15, 20, 25, 30];
    const yValues2 = [0, 1500000, 3500000, 3000000, 2000000, 1200000, 2000000];
    const myChart2 = new Chart("myChart2", {
        type: "line",
        data: {
            labels: xValues2,
            datasets: [{
                // Specify gradient using Chart.js's helper function:
                backgroundColor: "rgba(0,207,232,0.42)",
                borderColor: "#00cfe8",
                data: yValues2
            }]
        },
        options: {
            legend: { display: false },
        }
    });
</script>
@endpush
