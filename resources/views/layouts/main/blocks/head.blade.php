<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title_seo',@$default_seo['title_seo'])</title>
    <meta name="title" content="@yield('title_seo',@$default_seo['title_seo'])">
    <meta name="description" content="@yield('description_seo',@$default_seo['description_seo'])"/>
    @if($default_seo['noindex'])
        <meta name="robots" content="noindex,nofollow">
        <meta name="googlebot" content="noindex,nofollow">
    @else
        <meta name="robots"
              content="@yield('robots','index,follow')">
        <meta name="googlebot"
              content="@yield('robots','index,follow')">
    @endif
    <link rel="canonical" href="{{$canonical}}"/>
    <meta property="og:site_name" content="@yield('title',@$settings['siteName_fa'])"/>
    <meta property="og:title" content="@yield('title_seo',@$default_seo['title_seo'])">
    <meta property="og:description" content="@yield('description_seo',@$default_seo['description_seo'])"/>
    <meta property="og:locale" content="fa_IR"/>
    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:image" content="@yield('image_seo',asset('assets/uploads/setting/'.@$settings['logo']))"/>
    <link rel="stylesheet" href="{{asset('assets/site/css/shared/bootstrap.rtl.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/shared/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/shared/public.css?v0.20')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/shared/dev.css')}}">

{{--    favicon--}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/uploads/setting/'.@$settings['favicon'])}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/uploads/setting/'.@$settings['favicon'])}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/uploads/setting/'.@$settings['favicon'])}}">
    <link rel="manifest" href="{{asset('assets/uploads/setting/'.@$settings['favicon'])}}t">
    {!! @$settings['head_codes'] !!}
    <style>
        :root {
            --color-one: {{json_decode($themes['color_type'],true)['color-one']}};
            --color-two: {{json_decode($themes['color_type'],true)['color-two']}};
            --color-body: {{json_decode($themes['color_type'],true)['color-body']}};
        }
    </style>
    @stack('styles')
    <script src="https://www.rahweb.com/assets/admin/js/vue.js"></script>
    <script src="{{asset('assets/site/js/axios.min.js')}}"></script>
    <script src="{{asset('assets/site/js/sweetalert.min.js')}}"></script>
</head>
