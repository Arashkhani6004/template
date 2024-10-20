<!DOCTYPE html>
<html lang="fa" dir="rtl">
@include('layouts.main.blocks.head')

<body>
    @include('layouts.main.blocks.menu')
    {{--Review :  قسمت زیر منو و مگا منو پویا شود--}}
    @if($themes['menu_type'] == "mega_menu")
    @include('layouts.main.blocks.mega-menu')
    @endif
    {{--Todo : سرچ پویا شود--}}
    @include('layouts.main.blocks.search')
    <section class="hero position-relative">

    </section>
    <section class="panel mt-lg-0 mt-5">
        <div class="container">
            <div class="row w-100 m-0">
                <div class="col-lg-3 p-1">
                    {{--Sidebar Dsktop--}}
                        @include('pages.panel.blocks.sidebar')
                    {{--Sidebar Mobile--}}
                        @include('pages.panel.blocks.sidebar-mobile')
                </div>
                <div class="col-lg-9 p-1">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>
    @include('layouts.main.blocks.footer')
    @include('layouts.main.blocks.script')
</body>

</html>