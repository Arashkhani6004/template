<div class="collection d-md-block d-none">
    <div class="row w-100 m-0 h-100">
        <div class="col-sm py-xxl-0 py-xl-0 p-xxl-3 p-xl-2 p-1 h-100 d-xl-block d-lg-none d-none">
            <div class="collection-img first d-flex flex-column justify-content-end h-100">

                {{-- Todo ui : spell mistake -> img-gallry Done--}}
                <img src="{{$settings['first_page_about_image_1']}}" class="w-100 img-gallery" alt="about-img"
                     title="about-img" loading="lazy">

            </div>
        </div>
        <div class="col-sm py-xxl-0 py-xl-0 p-xxl-3 p-xl-2 p-1 h-100 d-sm-block d-none">
            <div class="collection-img second d-flex flex-column justify-content-end h-100">

                @if(isset($settings['first_page_about_image_2']))
                    <img src="{{$settings['first_page_about_image_2']}}" class="w-100 mb-5 img-gallery" alt="about-img"
                         title="about-img" loading="lazy">

                @endif
                <div class="select-form">
                <i class="bi bi-geo-alt-fill d-flex dynamic-color"></i>
                    <div class="w-100 mt-4">
                        <label class="small mb-1 font-th dynamic-color ">انتخاب شعبه</label>
                        <select class="form-select mb-2 font-re dynamic-color" aria-label="Default select example"
                                v-model="mainBranch">
                            <option v-for="branch in branches" :value="branch">@{{ branch.title }}</option>
                        </select>
                        <a v-if="mainBranch.map" rel="nofollow" target="_blank"  type="button" :href="mainBranch.map"
                           class="btn btn-form font-th position-relative">مسیریابی از روی نقشه</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm py-xxl-0 py-xl-0 p-xxl-3 p-xl-2 p-1 h-100 d-xxl-block d-xl-none d-lg-block d-none">
            <div class="collection-img third d-flex flex-column justify-content-end h-100">

                <img src="{{$settings['first_page_about_image_3']}}" class="w-100 img-gallery" alt="about-img"
                     title="about-img" loading="lazy">

            </div>
        </div>
        <div class="col-sm py-xxl-0 py-xl-0 p-xxl-3 p-xl-2 p-1 h-100 d-sm-block d-none">
            <div class="collection-img fourth d-flex flex-column justify-content-end h-100">
                <a href="tel:{{$settings['main_phone_number']}}"
                   class="btn-arrow-two d-flex justify-content-between py-4 mb-5 h-rotate dynamic-color">
                    <div class="d-flex align-items-center">
                    <i class="bi bi-telephone-fill d-flex fs-5 m-10-l "></i>
                        <div>
                            <p class="mb-0 font-th" dir="ltr">@toPersianNumber($settings['main_phone_number'])</p>
                            <span class="d-flex align-items-center font-small op-light font-th">
                                           {!! @$settings['call_salon'] !!}
                                        </span>
                        </div>
                    </div>
                    <span class="arrow-box m-0">
                                    <img src="{{asset('assets/site/images/left-top-arrow-dark.svg')}}" class="main-icon"
                                         width="25" height="25" alt="آیکن فلش" title="آیکن فلش" loading="lazy">
                                </span>
                </a>

                <img src="{{$settings['first_page_about_image_4']}}" class="w-100 img-gallery" alt="about-img"
                     title="about-img" loading="lazy">

            </div>
        </div>
        <div class="col-sm py-xxl-0 py-xl-0 p-xxl-3 p-xl-2 p-1 h-100 d-xl-block d-lg-none d-none">
            <div class="collection-img fifth d-flex flex-column justify-content-end h-100">

                <img src="{{$settings['first_page_about_image_5']}}" class="w-100 img-gallery" alt="about-img"
                     title="about-img" loading="lazy">

            </div>
        </div>
    </div>
</div>
<div class="collection-mobile d-md-none d-block">
    <div class="row w-100 m-0 top mb-2">
        <div class="col-4 p-1">
            <img src="{{$settings['first_page_about_image_1']}}" class="w-100" alt="about-img" title="about-img"
                 loading="lazy">
        </div>
        <div class="col-4 p-1">
            <img src="{{$settings['first_page_about_image_2']}}" class="w-100" alt="about-img" title="about-img"
                 loading="lazy">
        </div>
        <div class="col-4 p-1">
            <img src="{{$settings['first_page_about_image_3']}}" class="w-100" alt="about-img" title="about-img"
                 loading="lazy">
        </div>
    </div>
    <div class="select-form mb-2" v-cloak>
        <i class="bi bi-geo-alt-fill d-flex dynamic-color"></i>
        <div class="w-100 mt-4">
            <label class="small mb-1 font-th dynamic-color">انتخاب شعبه</label>
            <select class="form-select mb-2 font-re dynamic-color" aria-label="Default select example" v-model="mainBranch">
                <option v-for="branch in branches" :value="branch">@{{ branch.title }}</option>
            </select>
            <a rel="nofollow" v-if="mainBranch.map" target="_blank" type="button" :href="mainBranch.map"
               class="btn btn-form font-th position-relative">مسیریابی از روی نقشه</a>
        </div>
    </div>
    <a href="tel:{{$settings['main_phone_number']}}" class="btn-arrow-two d-flex justify-content-between py-4 h-rotate dynamic-color">
        <div class="d-flex align-items-center">
        <i class="bi bi-telephone-fill d-flex fs-5 m-10-l "></i>
            <div>
                <p class="mb-0 font-th" dir="ltr">@toPersianNumber($settings['main_phone_number'])</p>
                <span class="d-flex align-items-center font-small op-light font-th">
                                {{--Review : لزوما قرار نیست سالن باشه--}}
                    {{@$settings['call_salon']}}
                            </span>
            </div>
        </div>
        <span class="arrow-box m-0">
                        <img src="{{asset('assets/site/images/left-top-arrow-dark.svg')}}" class="main-icon" width="25"
                             height="25" alt="arrow-icon" title="arrow-icon" loading="lazy">
                    </span>
    </a>
    <div class="row w-100 m-0 bottom mt-2">
        <div class="col-6 p-1">
            <img src="{{$settings['first_page_about_image_4']}}" class="w-100" alt="about-img" title="about-img"
                 loading="lazy">
        </div>
        <div class="col-6 p-1">
            <img src="{{$settings['first_page_about_image_5']}}" class="w-100" alt="about-img" title="about-img"
                 loading="lazy">
        </div>
    </div>
</div>
