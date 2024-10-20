<!DOCTYPE html>
<html lang="fa" dir="rtl">
    @include('layouts.main.blocks.head')
    <body>
    {!! @$settings['body_codes'] !!}
        @include('layouts.main.blocks.menu')
        {{--Review :  قسمت زیر منو و مگا منو پویا شود--}}
        @if(@$themes['menu_type'] == "mega_menu")
        @include('layouts.main.blocks.mega-menu')
        @endif
        @if(@$themes['menu_type_category'] == "mega_menu")
            @include('layouts.main.blocks.mega-menu-category')
        @endif
        {{--Todo : سرچ پویا شود--}}
        @include('layouts.main.blocks.search')
            @yield('content')
        @include('layouts.main.blocks.footer')
        @include('layouts.main.blocks.script')
        @include('layouts.common.sweetalert')
    </body>
</html>
