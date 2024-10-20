<section class="menu mt-md-4 mt-2 position-absolute end-0 start-0 top-0">
    <div class="container">
        {{-- menu desktop --}}
        <div class="desktop-menu d-lg-block d-none">
            <div class="top pb-3 mb-3">
                <div class="row w-100 m-0">
                    <div class="col-lg-6 p-0">
                        @if($main_branch)
                        <ul class="p-0 m-0 d-flex align-items-center">
                            <li class="me-4">
                                <a href="{{$main_branch['map']}}" rel="nofollow"
                                    class="d-flex align-items-center light h-rotate">
                                    <img src="{{asset('assets/site/images/geo-icon.svg')}}"
                                        class="m-10-l main-icon change-color"
                                        width="25" height="25" alt="موقعیت مکانی" title="موقعیت مکانی">
                                    <div>
                                        <p class="mb-0 font-th ">{{$main_branch['title']}}</p>
                                        <span class="d-flex align-items-center font-small op-light font-th">
                                            {{'مسیریابی ' . @$settings['location_header_title']}}
                                            <img src="{{asset('assets/site/images/left-arrow-icon.svg')}}"
                                                class="m-10-r change-color" width="20" height="20"
                                                alt="مشاهده موقعیت مکانی"
                                                title="مشاهده موقعیت مکانی">
                                        </span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        @endif
                    </div>
                    <div class="col-lg-6 p-0">
                        <ul class="m-0 p-0 justify-content-end d-flex">
                            <li class="ms-4 drop-down">
                                    <a href="{{route('panel.dashboard')}}" class="d-flex align-items-center light h-rotate">
                                        <img src="{{asset('assets/site/images/Logon.svg')}}" class="m-10-l main-icon change-color" width="25" height="25" alt="call" title="call">
                                        <div>
                                            <p class="mb-0 font-th" dir="ltr"> @auth {{Auth::user()->full_name}} @else ورود @endauth </p>
                                            <span class="d-flex align-items-center font-small op-light font-th">
                                                 @auth  ورود به پنل کاربری @else ثبت نام @endauth
                                            </span>
                                        </div>
                                    </a>
                                    @auth
                                    <div class="drop-box">
                                        <ul class="p-0 m-0">
                                            <li class="list-unstyled border-bottom ms-0 px-2">
                                                <a href="#" class="font-num-r">
                                                    <i class="bi bi-person d-flex me-2"></i>
                                                    {{Auth::user()->mobile}}
                                                </a>
                                            </li>
                                            <li class="list-unstyled drop-down-in">
                                                <a href="{{route('panel.orders')}}">
                                                    <i class="bi bi-handbag d-flex me-2"></i>
                                                    سفارشات
                                                </a>
                                            </li>
{{--                                            <li class="list-unstyled">--}}
{{--                                                <a href="#">--}}
{{--                                                    <i class="bi bi-suit-heart d-flex me-2"></i>--}}
{{--                                                    علاقه مندی ها--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
                                            <li class="list-unstyled">
                                                <a href="{{route('panel.profile')}}">
                                                    <i class="bi bi-pencil-square d-flex me-2"></i>
                                                    ویرایش اطلاعات
                                                </a>
                                            </li>
                                            <li class="list-unstyled">
                                                <a href="{{route('auth.logout')}}">
                                                    <i class="bi bi-box-arrow-right d-flex me-2"></i>
                                                    خروج از حساب
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                     @endauth
                                </li>
                            @if(isset($settings['main_phone_number']))
                            <li class="ms-4">
                                <a href="tel:{{$settings['main_phone_number']}}"
                                    class="d-flex align-items-center light h-rotate">
                                    <img src="{{asset('assets/site/images/tel-icon.svg')}}"
                                        class="m-10-l main-icon change-color"
                                        width="25" height="25" alt="تماس" title="تماس">
                                    <div>
                                        <p class="mb-0 font-th"
                                            dir="ltr"> @toPersianNumber($settings['main_phone_number']) </p>
                                        <span class="d-flex align-items-center font-small op-light font-th">
                                            {{'تماس با '. @$settings['site_header_title']}}
                                            <img src="{{asset('assets/site/images/left-arrow-icon.svg')}}"
                                                class="m-10-r change-color" width="20" height="20" alt="تماس"
                                                title="تماس">
                                        </span>
                                    </div>
                                </a>
                            </li>
                            @endif
                        </ul>

                    </div>
                </div>
            </div>
            <div class="main-menu">
                <div class="row w-100 m-0">
                    <div class="col-xl-2 col-lg-2 align-self-center p-0">
                        <a href="{{route('index')}}">
                            <img src="{{$settings['logo']}}"
                                width="111" alt="{{$settings['siteName_fa']}}" title="{{$settings['siteName_fa']}}">
                        </a>
                    </div>
                    <div class="col-xl-8 col-lg-8 align-self-center p-0">
                        <ul class="menu-items p-0 m-0 d-flex align-items-center justify-content-center">
                            @foreach($settings['menu_links'] as $menu_item)
                            @if($menu_item['type'] == "default")
                            <li>
                                <a href="{{url(trim($menu_item['url']))}}"
                                    class="nav-link font-th small">{{$menu_item['title']}}</a>
                            </li>
                            @elseif($menu_item['type'] == "service")
                            @if($themes['menu_type'] == "mega_menu" && $menu_services)
                            <li>
                                <a href="{{route('service.list')}}" class="nav-link font-th small"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#megaModal">{{$menu_item['title']}}</a>
                            </li>
                            @elseif($themes['menu_type'] == "drop_down" && $menu_services)
                            <li class="drop-down">
                                <a href="{{route('service.list')}}" class="nav-link font-th small">
                                    {{$menu_item['title']}}
                                    <i class="bi bi-chevron-down d-flex ms-1"></i>
                                </a>
                                <div class="drop-box">
                                    <ul class="p-0 m-0">
                                        @foreach($menu_services as $menu_service_key => $menu_service)

                                        @if(count($menu_service['children']) > 0)
                                        <li class="list-unstyled drop-down-in">
                                            <a href="{{ route('service.detail', ['url' => $menu_service['url']]) }}">
                                                {{$menu_service['title']}}
                                                <i class="bi bi-chevron-left d-flex ms-1"></i>
                                            </a>
                                            <div class="drop-box-in">
                                                <ul class="p-0 m-0 ">
                                                    @foreach($menu_service['children'] as $menu_service_children)

                                                    @if(count($menu_service_children['children']) > 0)
                                                    <li class="list-unstyled drop-down-inn">
                                                        <a href="{{ route('service.detail', ['url' => $menu_service_children['url']]) }}">
                                                            {{$menu_service_children['title']}}
                                                            <i class="bi bi-chevron-left d-flex ms-1"></i>
                                                        </a>
                                                        <div class="drop-box-inn">
                                                            <ul class="p-0 m-0 ">
                                                                @foreach($menu_service_children['children'] as $menu_service_child)
                                                                <li class="list-unstyled">
                                                                    <a href="{{ route('service.detail', ['url' => $menu_service_child['url']]) }}">
                                                                        {{$menu_service_child['title']}}
                                                                    </a>
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </li>
                                                    @else
                                                    <li class="list-unstyled">
                                                        <a href="{{ route('service.detail', ['url' => $menu_service_children['url']]) }}">
                                                            {{$menu_service_children['title']}}</a>
                                                    </li>
                                                    @endif
                                                    @endforeach

                                                </ul>
                                            </div>
                                        </li>
                                        @else
                                        <li class="list-unstyled">
                                            <a href="{{ route('service.detail', ['url' => $menu_service['url']]) }}">{{$menu_service['title']}}</a>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            @endif
                            @elseif($menu_item['type'] == "product")
                            @if(@$themes['menu_type_category'] == "mega_menu" && $menu_product_categories)
                            <li>
                                <a href="{{route('category.list')}}" class="nav-link font-th small"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#megaModalCategory">{{$menu_item['title']}}</a>
                            </li>
                            @elseif(@$themes['menu_type_category'] == "drop_down" && $menu_product_categories)
                            <li class="drop-down">
                                <a href="{{route('category.list')}}" class="nav-link font-th small">
                                    {{$menu_item['title']}}
                                    <i class="bi bi-chevron-down d-flex ms-1"></i>
                                </a>
                                <div class="drop-box">
                                    <ul class="p-0 m-0">
                                        @foreach($menu_product_categories as $menu_product_category_key => $menu_product_category)
                                        @if(count($menu_product_category['children']) > 0)
                                        <li class="list-unstyled drop-down-in">
                                            <a href="{{ route('category.detail', ['url' => $menu_product_category['url']]) }}">
                                                {{$menu_product_category['title']}}
                                                <i class="bi bi-chevron-left d-flex ms-1"></i>
                                            </a>
                                            <div class="drop-box-in">
                                                <ul class="p-0 m-0 ">
                                                    @foreach($menu_product_category['children'] as $menu_product_category_children)

                                                    @if(count($menu_product_category_children['children']) > 0)
                                                    <li class="list-unstyled drop-down-inn">
                                                        <a href="{{ route('category.detail', ['url' => $menu_product_category_children['url']]) }}">
                                                            {{$menu_product_category_children['title']}}
                                                            <i class="bi bi-chevron-left d-flex ms-1"></i>
                                                        </a>
                                                        <div class="drop-box-inn">
                                                            <ul class="p-0 m-0 ">
                                                                @foreach($menu_product_category_children['children'] as $menu_product_category_child)
                                                                <li class="list-unstyled">
                                                                    <a href="{{ route('category.detail', ['url' => $menu_product_category_child['url']]) }}">
                                                                        {{$menu_product_category_child['title']}}
                                                                    </a>
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </li>
                                                    @else
                                                    <li class="list-unstyled">
                                                        <a href="{{ route('category.detail', ['url' => $menu_product_category_children['url']]) }}">
                                                            {{$menu_product_category_children['title']}}</a>
                                                    </li>
                                                    @endif
                                                    @endforeach

                                                </ul>
                                            </div>
                                        </li>
                                        @else
                                        <li class="list-unstyled">
                                            <a href="{{ route('category.detail', ['url' => $menu_product_category['url']]) }}">{{$menu_product_category['title']}}</a>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            @endif
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-xl-2 col-lg-2 align-self-center p-0">
                        <ul class="p-0 m-0 d-flex justify-content-end align-items-center gap-4">
                             <li>
                             <a href="{{route('basket.cart')}}" type="button" class="btn p-0 border-0 shadow-none bg-transparent" >
                             <img src="{{asset('assets/site/images/Bag.png')}}" class="change-color" width="25" height="25" alt="cart" title="cart">
                             </a>
                             </li>
                            <li>
                                <button type="button" class="btn p-0 border-0 shadow-none bg-transparent"
                                    data-bs-toggle="offcanvas" data-bs-target="#searchCanvas"
                                    aria-controls="offcanvasTop">
                                    <img src="{{asset('assets/site/images/search-icon.svg')}}" class="change-color"
                                        width="25" height="25"
                                        alt="search" title="search">
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- menu mobile --}}
        <div class="mobile-menu d-lg-none d-block">
            <div class="top pb-3 mb-2">
                <div class="row w-100 m-0">
                    <div class="col-6 p-0 align-self-center">
                        <ul class="p-0 m-0 d-flex align-items-center">
                            <li class="me-4">
                                <a href="{{route('index')}}" class="d-flex align-items-center light">
                                    <img
                                        src="{{$settings['logo']}}"
                                        width="90" alt="{{$settings['siteName_fa']}}"
                                        title="{{$settings['siteName_fa']}}">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-6 p-0 align-self-center">
                        @if(isset($settings['main_phone_number']))
                        <ul class="m-0 p-0 justify-content-end d-flex">
                            <li>
                                <a href="tel:{{$settings['main_phone_number']}}"
                                    class="d-flex align-items-center light">
                                    <img src="{{asset('assets/site/images/tel-icon.svg')}}"
                                        class="m-10-l change-color" width="20"
                                        height="20" alt="تماس" title="تماس">
                                    <div>
                                        <p class="mb-0 font-th"
                                            dir="ltr"> @toPersianNumber($settings['main_phone_number']) </p>
                                        <span class="d-flex align-items-center font-small op-light font-th">
                                            ارتباط با ما
                                            <img src="{{asset('assets/site/images/left-arrow-icon.svg')}}"
                                                class="m-10-r change-color" width="20" height="20" alt="call"
                                                title="call">
                                        </span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
            <div class="main-menu">
                <div class="row w-100 m-0">
                    <div class="col-6 align-self-center p-0">
                        <button class="btn bg-transparent p-0 border-0 shadow-none light" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                            aria-controls="offcanvasExample">
                            <i class="bi bi-list d-flex fs-1"></i>
                        </button>
                        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
                            aria-labelledby="offcanvasExampleLabel">
                            <div class="offcanvas-header">
                                <img
                                    src="{{$settings['logo']}}"
                                    width="60" alt="{{$settings['siteName_fa']}}" title="{{$settings['siteName_fa']}}">
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body p-2">
                                <ul class="menu-items p-0 m-0">
                                    <li>
                                        <a href="{{route('index')}}" class="nav-link small d-flex align-items-center">
                                            <i class="bi bi-house-fill d-flex fs-5 me-2 color-theme-two"></i>
                                            صفحه اصلی
                                        </a>
                                    </li>
                                    <!-- اکر خدمات زیر مجموعه نداشت -->
                                    <li>
                                        <a href="{{route('service.list')}}" class="nav-link small d-flex align-items-center">
                                            <i class="bi bi-boxes d-flex fs-5 me-2 color-theme-two"></i>
                                            خدمات
                                        </a>
                                    </li>
                                    <!---->
{{--                                    <div class="accordion" id="accordionExample">--}}
{{--                                        <!-- اکر خدمات زیر مجموعه داشت -->--}}
{{--                                        <div class="accordion-item border-0 border-bottom mx-2 mb-1">--}}
{{--                                            <p class="accordion-header">--}}
{{--                                                <button class="accordion-button border-0 shadow-none p-2 d-flex align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">--}}
{{--                                                    <i class="bi bi-boxes d-flex fs-5 me-2 color-theme-two"></i>--}}
{{--                                                    خدمات--}}
{{--                                                </button>--}}
{{--                                            </p>--}}
{{--                                            <div id="collapseOne" class="accordion-collapse collapse lvl1" data-bs-parent="#accordionExample">--}}
{{--                                                <div class="accordion-body bg-light shadow-sm p-0 rounded-2 mb-3">--}}
{{--                                                    <ul class="p-0 m-0">--}}
{{--                                                        <li class="list-unstyled m-0">--}}
{{--                                                            <a href="#" class="d-flex align-items-center small">--}}
{{--                                                                <i class="bi bi-caret-left-fill me-1 d-flex color-theme-two"></i>--}}
{{--                                                                مشاهده خدمات--}}
{{--                                                            </a>--}}
{{--                                                        </li>--}}
{{--                                                        <li class="list-unstyled m-0">--}}
{{--                                                            <a href="#" class="d-flex align-items-center small">--}}
{{--                                                                <i class="bi bi-dot d-flex color-theme-two"></i>--}}
{{--                                                                زیر دسته بدون فرزند--}}
{{--                                                            </a>--}}
{{--                                                        </li>--}}
{{--                                                        <li class="list-unstyled m-0">--}}
{{--                                                            <div class="accordion accordion-flush lvl2" id="accordionFlushExample">--}}
{{--                                                                <div class="accordion-item bg-transparent border-0 border-bottom mb-1">--}}
{{--                                                                    <p class="accordion-header">--}}
{{--                                                                        <button class="small accordion-button bg-transparent collapsed d-flex align-items-center  border-0 shadow-none p-2" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">--}}
{{--                                                                            <i class="bi bi-dot d-flex color-theme-two"></i>--}}
{{--                                                                            زیردسته بافرزند۱--}}
{{--                                                                        </button>--}}
{{--                                                                    </p>--}}
{{--                                                                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">--}}
{{--                                                                        <div class="accordion-body p-1 mb-2 rounded-3 shadow-sm">--}}
{{--                                                                            <ul class="m-0 p-0">--}}
{{--                                                                                <li class="list-unstyled m-0">--}}
{{--                                                                                    <a href="#" class="d-flex align-items-center small">--}}
{{--                                                                                        <i class="bi bi-caret-left-fill me-1 d-flex color-theme-two"></i>--}}
{{--                                                                                        مشاهده زیردسته بافرزند۱--}}
{{--                                                                                    </a>--}}
{{--                                                                                </li>--}}
{{--                                                                                <li class="list-unstyled m-0">--}}
{{--                                                                                    <a href="#" class="d-flex align-items-center small">--}}
{{--                                                                                        <i class="bi bi-dot d-flex color-theme-two"></i>--}}
{{--                                                                                        زیر دسته بدون فرزند--}}
{{--                                                                                    </a>--}}
{{--                                                                                </li>--}}
{{--                                                                            </ul>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="accordion-item bg-transparent border-0 border-bottom mb-1">--}}
{{--                                                                    <p class="accordion-header">--}}
{{--                                                                        <button class="accordion-button collapsed bg-transparent d-flex align-items-center  border-0 shadow-none p-2" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">--}}
{{--                                                                            <i class="bi bi-dot d-flex color-theme-two"></i>--}}
{{--                                                                            زیردسته بافرزند ۲--}}
{{--                                                                        </button>--}}
{{--                                                                    </p>--}}
{{--                                                                    <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">--}}
{{--                                                                        <div class="accordion-body p-1 mb-2 rounded-3 shadow-sm">--}}
{{--                                                                            <ul class="m-0 p-0">--}}
{{--                                                                                <li class="list-unstyled m-0">--}}
{{--                                                                                    <a href="#" class="d-flex align-items-center small">--}}
{{--                                                                                        <i class="bi bi-caret-left-fill me-1 d-flex color-theme-two"></i>--}}
{{--                                                                                        مشاهده زیردسته بافرزند۱--}}
{{--                                                                                    </a>--}}
{{--                                                                                </li>--}}
{{--                                                                                <li class="list-unstyled m-0">--}}
{{--                                                                                    <a href="#" class="d-flex align-items-center small">--}}
{{--                                                                                        <i class="bi bi-dot d-flex color-theme-two"></i>--}}
{{--                                                                                        زیر دسته بدون فرزند--}}
{{--                                                                                    </a>--}}
{{--                                                                                </li>--}}
{{--                                                                            </ul>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <a href="#" class="d-flex align-items-center small">--}}
{{--                                                                <i class="bi bi-dot d-flex color-theme-two"></i>--}}
{{--                                                                زیر دسته بدون فرزند--}}
{{--                                                            </a>--}}
{{--                                                        </li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!-- اکر محصولات زیر مجموعه داشت -->--}}
{{--                                        <div class="accordion-item border-0 border-bottom mx-2 mb-1">--}}
{{--                                            <p class="accordion-header">--}}
{{--                                                <button class="accordion-button border-0 shadow-none p-2 d-flex align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">--}}
{{--                                                    <i class="bi bi-box d-flex fs-5 me-2 color-theme-two"></i>--}}
{{--                                                    محصولات--}}
{{--                                                </button>--}}
{{--                                            </p>--}}
{{--                                            <div id="collapseTwo" class="accordion-collapse collapse lvl1" data-bs-parent="#accordionExample">--}}
{{--                                                <div class="accordion-body bg-light shadow-sm p-0 rounded-2 mb-3">--}}
{{--                                                    <ul class="p-0 m-0">--}}
{{--                                                        <li class="list-unstyled m-0">--}}
{{--                                                            <a href="#" class="d-flex align-items-center small">--}}
{{--                                                                <i class="bi bi-caret-left-fill me-1 d-flex color-theme-two"></i>--}}
{{--                                                                مشاهده محصولات--}}
{{--                                                            </a>--}}
{{--                                                        </li>--}}
{{--                                                        <li class="list-unstyled m-0">--}}
{{--                                                            <a href="#" class="d-flex align-items-center small">--}}
{{--                                                                <i class="bi bi-dot d-flex color-theme-two"></i>--}}
{{--                                                                زیر دسته بدون فرزند--}}
{{--                                                            </a>--}}
{{--                                                        </li>--}}
{{--                                                        <li class="list-unstyled m-0">--}}
{{--                                                            <div class="accordion accordion-flush lvl2" id="accordionFlushExample2">--}}
{{--                                                                <div class="accordion-item bg-transparent border-0 border-bottom mb-1">--}}
{{--                                                                    <p class="accordion-header">--}}
{{--                                                                        <button class="small accordion-button bg-transparent collapsed d-flex align-items-center  border-0 shadow-none p-2" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne1" aria-expanded="false" aria-controls="flush-collapseOne1">--}}
{{--                                                                            <i class="bi bi-dot d-flex color-theme-two"></i>--}}
{{--                                                                            زیردسته بافرزند۱--}}
{{--                                                                        </button>--}}
{{--                                                                    </p>--}}
{{--                                                                    <div id="flush-collapseOne1" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample2">--}}
{{--                                                                        <div class="accordion-body p-1 mb-2 rounded-3 shadow-sm">--}}
{{--                                                                            <ul class="m-0 p-0">--}}
{{--                                                                                <li class="list-unstyled m-0">--}}
{{--                                                                                    <a href="#" class="d-flex align-items-center small">--}}
{{--                                                                                        <i class="bi bi-caret-left-fill me-1 d-flex color-theme-two"></i>--}}
{{--                                                                                        مشاهده زیردسته بافرزند۱--}}
{{--                                                                                    </a>--}}
{{--                                                                                </li>--}}
{{--                                                                                <li class="list-unstyled m-0">--}}
{{--                                                                                    <a href="#" class="d-flex align-items-center small">--}}
{{--                                                                                        <i class="bi bi-dot d-flex color-theme-two"></i>--}}
{{--                                                                                        زیر دسته بدون فرزند--}}
{{--                                                                                    </a>--}}
{{--                                                                                </li>--}}
{{--                                                                            </ul>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="accordion-item bg-transparent border-0 border-bottom mb-1">--}}
{{--                                                                    <p class="accordion-header">--}}
{{--                                                                        <button class="accordion-button collapsed bg-transparent d-flex align-items-center  border-0 shadow-none p-2" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo1" aria-expanded="false" aria-controls="flush-collapseTwo1">--}}
{{--                                                                            <i class="bi bi-dot d-flex color-theme-two"></i>--}}
{{--                                                                            زیردسته بافرزند ۲--}}
{{--                                                                        </button>--}}
{{--                                                                    </p>--}}
{{--                                                                    <div id="flush-collapseTwo1" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample2">--}}
{{--                                                                        <div class="accordion-body p-1 mb-2 rounded-3 shadow-sm">--}}
{{--                                                                            <ul class="m-0 p-0">--}}
{{--                                                                                <li class="list-unstyled m-0">--}}
{{--                                                                                    <a href="#" class="d-flex align-items-center small">--}}
{{--                                                                                        <i class="bi bi-caret-left-fill me-1 d-flex color-theme-two"></i>--}}
{{--                                                                                        مشاهده زیردسته بافرزند۱--}}
{{--                                                                                    </a>--}}
{{--                                                                                </li>--}}
{{--                                                                                <li class="list-unstyled m-0">--}}
{{--                                                                                    <a href="#" class="d-flex align-items-center small">--}}
{{--                                                                                        <i class="bi bi-dot d-flex color-theme-two"></i>--}}
{{--                                                                                        زیر دسته بدون فرزند--}}
{{--                                                                                    </a>--}}
{{--                                                                                </li>--}}
{{--                                                                            </ul>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <a href="#" class="d-flex align-items-center small">--}}
{{--                                                                <i class="bi bi-dot d-flex color-theme-two"></i>--}}
{{--                                                                زیر دسته بدون فرزند--}}
{{--                                                            </a>--}}
{{--                                                        </li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                            {{--<li>
                                        <a href="{{route('portfolio.list')}}" class="nav-link small d-flex align-items-center">
                                            <i class="bi bi-front d-flex fs-5 me-2 color-theme-two"></i>
                                            نمونه کارها
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('gallery.category')}}" class="nav-link small d-flex align-items-center">
                                            <i class="bi bi-images d-flex fs-5 me-2 color-theme-two"></i>
                                            گالری
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('blog.category-list')}}" class="nav-link small d-flex align-items-center">
                                            <i class="bi bi-newspaper d-flex fs-5 me-2 color-theme-two"></i>
                                            بلاگ
                                        </a>
                                    </li>--}}
                                    @foreach($settings['menu_links'] as $menu_item)
                                    @if($menu_item['type'] == "default")
                                    <li>
                                        <a href="{{url(trim($menu_item['url']))}}" class="nav-link small d-flex align-items-center">
                                            <i class="bi bi-dot d-flex fs-5 me-2 color-theme-two"></i>
                                            {{$menu_item['title']}}
                                        </a>
                                    </li>
                                    @elseif($menu_item['type'] == "service")
                                    <li>
                                        <a href="{{route('service.list')}}"
                                            class="nav-link small d-flex align-items-center">
                                            <i class="bi bi-dot d-flex fs-5 me-2 color-theme-two"></i>
                                            {{$menu_item['title']}}
                                        </a>
                                    </li>
                                    @elseif($menu_item['type'] == "product")
                                    <li>
                                        <a href="{{route('category.list')}}"
                                            class="nav-link small d-flex align-items-center">
                                            <i class="bi bi-dot d-flex fs-5 me-2 color-theme-two"></i>
                                            {{$menu_item['title']}}
                                        </a>
                                    </li>
                                    @endif
                                    @endforeach
                                    @if($main_branch)
                                    <li>
                                        <a href="{{$main_branch['map']}}" rel="nofollow"
                                            class="d-flex align-items-center">
                                            <i class="bi bi-geo-alt d-flex fs-5 me-2 color-theme-two"></i>
                                            <div>
                                                <p class="mb-0 small ">{{$main_branch['title']}}</p>
                                                <span class="d-flex align-items-center font-small op-light font-th">
                                                    {{'مسیریابی ' . $settings['siteName_fa']}}
                                                    <i class="bi bi-arrow-left-short d-flex text-dark ms-2"></i>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 align-self-center p-0">
                        <ul class="p-0 m-0 d-flex justify-content-end align-items-center">
                            <li>
                                <a href="#" class="nav-link" data-bs-toggle="offcanvas" data-bs-target="#searchCanvas"
                                    aria-controls="offcanvasTop">
                                    <img src="{{asset('assets/site/images/search-icon.svg')}}" class="change-color"
                                        width="25" height="25"
                                        alt="search" title="search">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.main.blocks.menu-app')
