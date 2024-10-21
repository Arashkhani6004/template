<!doctype html>
<html class="no-js" lang="fa" dir="rtl">
    @include('CmsCore::_layouts.blocks.head')
    <body class="rtl_mode" style>
    <style>
        .swal2-container {
            z-index: 11111111111 !important;
        }
    </style>
    @include('CmsCore::components.sweetalert')
        <div id="ebazar-layout" class="theme-blue">
            @include('CmsCore::_layouts.blocks.sidebar')
            <div class="main px-lg-4 px-md-4">
                @include('CmsCore::_layouts.blocks.mobile-sidebar')
                @include('CmsCore::_layouts.blocks.header')
                @yield('content')
            </div>
        </div>
    @include('CmsCore::_layouts.blocks.script')
    </body>
</html>
