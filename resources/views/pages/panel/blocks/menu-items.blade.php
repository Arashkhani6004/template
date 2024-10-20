<div class="side-box">
    <ul class="p-0 m-0">
        <li class="list-unstyled py-1">
            <a href="{{route('panel.dashboard')}}" class="d-flex p-2 align-items-center rounded-custom  @yield('dashboard') dynamic-color">
                <i class="bi bi-speedometer2 me-2 d-flex"></i>
                داشبورد
            </a>
        </li>
        <li class="list-unstyled py-1">
            <a href="{{route('panel.profile')}}" class="d-flex p-2 align-items-center rounded-custom @yield('profile') dynamic-color">
                <i class="bi bi-pencil-square me-2 d-flex"></i>
                ویرایش اطلاعات
            </a>
        </li>
{{--        <li class="list-unstyled py-1">--}}
{{--            <a href="" class="d-flex p-2 align-items-center rounded-custom dynamic-color">--}}
{{--                <i class="bi bi-mailbox me-2 d-flex"></i>--}}
{{--                تیکت ها--}}
{{--                <span class="d-flex ms-1 align-items-center rounded-custom font-num-r">(5)</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="list-unstyled py-1">--}}
{{--            <a href="" class="d-flex p-2 align-items-center rounded-custom dynamic-color">--}}
{{--                <i class="bi bi-suit-heart me-2 d-flex"></i>--}}
{{--                علاقه مندی ها--}}
{{--            </a>--}}
{{--        </li>--}}
        <li class="list-unstyled py-1">
            <a href="{{route('panel.orders')}}" class="d-flex p-2 align-items-center rounded-custom @yield('order') dynamic-color">
                <i class="bi bi-handbag me-2 d-flex"></i>
                سفارشات
            </a>
        </li>
{{--        <li class="list-unstyled py-1">--}}
{{--            <a href="" class="d-flex p-2 align-items-center rounded-custom dynamic-color">--}}
{{--                <i class="bi bi-columns-gap me-2 d-flex"></i>--}}
{{--                پکیج های من--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="list-unstyled py-1">--}}
{{--            <a href="" class="d-flex p-2 align-items-center rounded-custom dynamic-color">--}}
{{--                <i class="bi bi-collection-play me-2 d-flex"></i>--}}
{{--                دوره های من--}}
{{--            </a>--}}
{{--        </li>--}}
        <li class="list-unstyled py-1"><a href="{{route('panel.address')}}" class="d-flex p-2 align-items-center rounded-custom @yield('address') dynamic-color">
                <i class="bi bi-map me-2 d-flex"></i>
                آدرس ها
            </a>
        </li>


        <li class="list-unstyled py-1">
            <a href="{{route('auth.logout')}}" class="d-flex p-2 align-items-center rounded-custom dynamic-color">
                <i class="bi bi-power me-2 d-flex"></i>
                خروج از حساب
            </a>
        </li>
    </ul>
</div>
