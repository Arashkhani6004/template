@extends('layouts.main.master')
@section('robots', @$product->seoIndex == 0 ? 'index,follow' : 'noindex,nofollow')
@section('title_seo',@$product->seoTitle ? @$product->seoTitle : @$product->title)
@section('description_seo',@$product->seoDescription)
@section('image_seo',@$product->getImage('big'))
@section('content')
    <section class="hero position-relative">
    </section>
    <section class="product-page mt-2">
        <div class="container">
            <div class="product-info">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item">
                            <a href="{{route('index')}}" class="d-flex align-items-cente color-title font-re">
                                <i class="bi bi-house d-flex me-1"></i>
                                خانه
                            </a>
                        </li>
                        <li class="breadcrumb-item active color-title" aria-current="page">
                            {{@$product['title']}}
                        </li>
                    </ol>
                </nav>
                <div class="row w-100 m-0">
                    <div class="d-md-none d-block p-0 mb-3">
                        <div class="name border-bottom">
                            @include('pages.product-detail._partials.components.info')
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-12 ps-0 pe-xl-2 pe-lg-2 pe-0">
                        @include('pages.product-detail._partials.product-image')
                    </div>
                    <div class="col-xl-8 col-lg-8 col-12 pe-0 ps-xl-2 ps-lg-2 ps-0 mt-lg-0 mt-2" id="app" v-cloak>
                        @include('pages.product-detail._partials.info-product')
                        <div class="row w-100 m-0 mt-md-4">
                            <div class="col-md-6 p-0 pe-md-2">
                                {{--rate & share & like--}}
                                @include('pages.product-detail._partials.rate')

                                {{--select color--}}
                                @include('pages.product-detail._partials.colors')

                                {{--attributes--}}
                                @include('pages.product-detail._partials.attributes')

                                {{--selected specification--}}
                                {{-- @include('pages.product-detail._partials.selected-specification')--}}
                            </div>
                            <div class="col-md-6 p-0 ps-md-2">
                                <div class="price mt-md-0 mt-4">
                                    {{--slogans--}}
                                    @include('pages.product-detail._partials.slogan')
                                    {{--variables select--}}
                                    @if($product->mainVariant && $product->mainVariant->is_color != 1)
                                        <div class="mt-3 var-select">
                                            <label class="small color-title">انتخاب {{$product->mainVariant->title}} محصول</label>
                                            <select class="form-select" aria-label="Default select example" v-model="selectedOption">
                                                <option value="" selected> {{$product->mainVariant->title}} محصول را انتخاب کنید </option>
                                                @foreach($product->variants as $variant)
                                                    <option value="{{ json_encode($variant) }}" >{{@$variant->specification->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    @mobile
                                    <p class="m-0"></p>
                                    @else
                                        {{--add to cart for desktop--}}
                                        @include('pages.product-detail._partials.add-to-cart-desktop')
                                        @endmobile
                                </div>
                            </div>
                        </div>
                        @mobile
                        {{--add to cart for mobile--}}
                        @include('pages.product-detail._partials.add-to-cart-mobile')
                        @endmobile
                    </div>
                </div>
            </div>
            {{--tabs--}}
            @include('pages.product-detail._partials.tabs')

        </div>
        {{--related products--}}
        @include('pages.product-detail._partials.related')
        @include('pages.product-detail._partials.complement')
    </section>
@stop
@push('styles')
    <link rel="stylesheet" href="{{asset('assets/site/css/product/detail.css?v0.09')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/product/magiczoomplus.css')}}">
    <script src="{{asset('assets/site/js/sweetalert2.all.min.js')}}"></script>
@endpush
@push('scripts')
    <script src="{{asset('assets/site/js/product/magiczoomplus.js')}}"></script>
    <script src="{{asset('assets/site/js/product/detail.js?v0.02')}}"></script>
    <script>
        // Function to convert HEX to RGB
        function hexToRgb(hex) {
            // Remove the "#" if present
            const cleanHex = hex.replace('#', '');
            const bigint = parseInt(cleanHex, 16);
            const r = (bigint >> 16) & 255;
            const g = (bigint >> 8) & 255;
            const b = bigint & 255;
            return { r, g, b };
        }

        // Function to calculate brightness
        function getBrightness({ r, g, b }) {
            return (r * 299 + g * 587 + b * 114) / 1000;
        }

        // Function to update text color based on background brightness
        function updateTextColorActive() {
            // Select all elements with the class 'dynamic-color'
            const elements = document.querySelectorAll('.nav-link');

            elements.forEach((element) => {
                if(element.classList.contains('active')){
                    // Get the computed background color (assuming it's in HEX format)
                    const bgColor = getComputedStyle(element).getPropertyValue('--color-one').trim();

                    // Ensure the color is in HEX format, otherwise skip
                    if (bgColor.startsWith('#')) {
                        const rgbColor = hexToRgb(bgColor);
                        const brightness = getBrightness(rgbColor);
                        const textColor = brightness > 128 ? '#000' : '#fff';

                        // Apply the calculated text color to all text elements within the selected element
                        element.style.color = textColor;
                    }
                } else{
                    element.style.color = '';
                }

            });
        }

        // Call the function to update text colors
        updateTextColorActive();

    </script>
@endpush
@push('vue')
    @include('pages.product-detail._partials.vue')
@endpush
