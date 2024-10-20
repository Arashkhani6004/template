<section class="footer">
    <div class="container">
        <div class="row w-100 m-0">
            <div class="col-lg-5 col-md-12 mb-lg-0 mb-2 p-0">
                {{-- Review : add href --}}
                <a href="{{route('us.contact')}}" class="why-call color-title h-rotate dynamic-color">
                    <div class="text ms-3">
                        <p class="font-re mb-2 m-0">
                            {{@$settings['call_to_action_footer_text']}}
                        </p>
                        <div class="d-flex align-items-center flex-wrap font-th justify-content-end" dir="ltr">
                            @foreach ($settings['footer_contacts'] as $row)
                                <span href="tel:{{$row}}" class="me-3 color-title op-lighter dynamic-color">
                                        @toPersianNumber($row)
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="arrow">
                    <i class="bi bi-arrow-up-left d-flex main-icon dynamic-color fs-4"></i>
                    </div>
                </a>
            </div>
            <div class="col-lg-7 col-md-12 p-0 ">
                <div class="reason-call">
                    <div class="banner-scrollable overflow-hidden d-flex flex-nowrap">

                        @if(count($settings['footer_animation']) > 0)

                            <div class="scroll-text">
                                <ul class="m-0 p-0 d-flex align-items-center justify-content-center" dir="ltr">
                                    @foreach($settings['footer_animation'] as $text)
                                        <li class=" dynamic-color"> {{$text}} </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="scroll-text">
                                <ul class="m-0 p-0 d-flex align-items-center justify-content-center" dir="ltr">
                                    @foreach($settings['footer_animation'] as $text)
                                        <li class=" dynamic-color"> {{$text}} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-footer">
        <div class="container">
            <div class="row w-100 m-0">
                <div class="col-xl-5 p-1 d-flex flex-column mb-xl-0 mb-5">
                    <img
                        src="{{$settings['footer_logo']}}"
                        alt="{{$settings['siteName_fa']}}" title="{{$settings['siteName_fa']}}" width="111">
                    <div class="about mt-md-4 mt-4">
                        <p class="color-title font-re p-0">
                            {!! @$settings['footer_about_title'] !!}
                        </p>
                        <p class="color-title font-th op-lighter">
                            {!! @$settings['footer_about_text'] !!}
                        </p>
                    </div>
                    @if(@$settings['enamad'] != null || count(@$settings['footer_valids']) > 0)
                        <div class="namad mt-4">
                            <p class="color-title small mb-2">نمادها</p>
                            <ul class="p-0 m-0 d-flex flex-wrap align-items-center">
                                @if(@$settings['enamad'] != null)
                                <li class="list-unstyled">
                                    {!! @$settings['enamad'] !!}
                                </li>
                                @endif
                                @foreach(@$settings['footer_valids'] as $valid)
                                        <li class="list-unstyled">
                                            {!! @$valid !!}
                                        </li>
                                @endforeach

                            </ul>
                        </div>
                    @endif

                </div>
                <div class="col-xl-7 p-0">
                    <div class="row w-100 m-0">
                        <div class="col-md-6 px-md-3 p-1 mb-md-0 mb-4">
                            <div class="row w-100 m-0">
                                <div class="col-6 p-1">
                                    {{-- Review : check the links --}}
                                    <p class="font-re color-title mb-4">
                                        دسترسی سریع
                                    </p>
                                    <ul class="p-0 m-0">
                                        <li class="mb-3 small">
                                            <a href="{{route('index')}}" class="color-title font-th op-lighter">
                                                صفحه اصلی
                                            </a>
                                        </li>
                                        <li class="mb-3 small">
                                            <a href="{{ route('service.list') }}"
                                               class="color-title font-th op-lighter">
                                                {{@$settings['service_title_footer']}}
                                            </a>
                                        </li>
                                        <li class="mb-3 small">
                                            <a href="{{route('gallery.category')}}"
                                               class="color-title font-th op-lighter">
                                                گالری
                                            </a>
                                        </li>
                                        <li class="mb-3 small">
                                            <a href="{{route('category.list')}}" class="color-title font-th op-lighter">
                                                محصولات
                                            </a>
                                        </li>
                                        <li class="mb-3 small">
                                            <a href="{{route('blog.category-list')}}"
                                               class="color-title font-th op-lighter">
                                                مطالب و دانستنی ها
                                            </a>
                                        </li>
                                        <li class="mb-3 small">
                                            <a href="{{route('us.contact')}}" class="color-title font-th op-lighter">
                                                اطلاعات تماس
                                            </a>
                                        </li>
                                        <li class="mb-3 small">
                                            <a href="{{route('us.about')}}" class="color-title font-th op-lighter">
                                                درباره ما
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6 p-1">
                                    @if(@$settings['service_in_footer'] != 0)
                                        <p class="font-re color-title mb-4">
                                            {{@$settings['service_title_footer']}}
                                        </p>
                                        <ul class="p-0 m-0 mb-5">
                                            @foreach($footer_services as $service)
                                                <li class="mb-3 small">
                                                    {{-- Review : add href --}}
                                                    <a href="{{ route('service.detail', ['url' => $service['url']]) }}"
                                                       class="color-title font-th op-lighter">
                                                        {!! $service['title'] !!}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    @if(@$settings['category_in_footer'] == 1)
                                        <p class="font-re color-title mb-4">
                                            {{@$settings['category_title_footer']}}
                                        </p>
                                        <ul class="p-0 m-0">
                                            @foreach($menu_product_categories as $menu_product_category_key => $menu_product_category)
{{--                                                مممم--}}
                                                <li class="mb-3 small">
                                                    {{-- Review : add href --}}
                                                    <a href="{{ route('category.detail', ['url' => $menu_product_category['url']]) }}"
                                                       class="color-title font-th op-lighter">
                                                        {!! $menu_product_category['title'] !!}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ps-md-5 p-1 d-flex flex-column">
                            <div class="time">
                                <p class="font-re color-title mb-4">
                                    ارتباط با ما
                                </p>
                            </div>
                            <div class="social mt-md-0 mt-0 pt-xl-2">
                                <p class="color-title op-lighter font-re small mb-2">
                                    ما را در شبکه های اجتماعی دنبال کنید
                                </p>
                                <ul class="p-0 m-0 d-flex align-items-center">
                                    @foreach($socials as $social)
                                        <li class="me-4">
                                            <a href="{!! $social['link'] !!}" rel="nofollow">
                                                <i class="bi bi-{{$social['icon']}} fs-4 d-flex color-theme-one"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <a href="tel:{{$settings['main_phone_number']}}"
                               class="btn-arrow-two d-flex justify-content-between py-3 mt-4 w-100 h-rotate dynamic-color">
                                <div class="d-flex align-items-center">
                                <i class="bi bi-telephone-fill d-flex fs-5 m-10-l "></i>
                                    <div>
                                        <p class="mb-0 font-th" dir="ltr">
                                            @toPersianNumber($settings['main_phone_number'])</p>
                                        {{-- Review : change the text --}}
                                        <span class="d-flex align-items-center font-small op-light font-th">
                                             {{$settings['call_to_action_text']}}
                                        </span>
                                    </div>
                                </div>
                                <span class="arrow-box m-0">
                                    <img src="{{asset('assets/site/images/left-top-arrow-dark.svg')}}" class="main-icon"
                                         width="25" height="25" alt="arrow-icon" title="arrow-icon" loading="lazy">
                                </span>
                            </a>
                            <div class="col-12 p-1" id="branch_footer" v-cloak>
                                <div class="select-form mt-4">
                                <i class="bi bi-geo-alt-fill d-flex dynamic-color"></i>
                                    <div class="w-100 mt-4">
                                        <label class="small mb-1 font-th dynamic-color">انتخاب شعبه</label>
                                        <select class="form-select mb-2 font-re dynamic-color" aria-label="Default select example"
                                                v-model="mainBranch">
                                            <option v-for="branch in branches" :value="branch"
                                                    :selected="branch.main === 1">
                                                @{{ branch.title }}
                                            </option>
                                        </select>
                                        <a v-if="mainBranch.map" type="button" target="_blank" :href="mainBranch.map"
                                           class="btn btn-form font-th position-relative" rel="nofollow">
                                            مسیریابی از روی نقشه
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('vue')
    @include('layouts.main.blocks.main-vue',['element_id'=>'branch_footer'])
    @include('layouts.main.blocks.search-vue')
@endpush
