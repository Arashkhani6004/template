<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#2a2a2a">
    <link rel="shortcut icon" href="{{asset('assets/admin/images/fav.jpg')}}" type="image/x-icon" />
    <title>@yield('title','داشبورد')</title>
    <meta name="robots" content=" noindex nofollow" />
    <link href="{{asset('assets/admin/css/bootstrap.rtl.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/admin/css/admin.style.min.css?v0.29')}}" />
    <link rel="stylesheet" href="{{asset('assets/admin/css/app.css?v0.29')}}" />
    <link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap-datepicker.min.css?v0.0')}}" />
    <link rel="stylesheet" href="{{asset('assets/admin/css/perfect-scrollbar.css')}}" />
    <script src="{{asset('assets/admin/js/axios.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/sweetalert2.all.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/admin/css/233bootstrap-select.min.css')}}">
    @stack('styles')
</head>
