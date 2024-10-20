<section class="about-us" id="about_us_branch">
    <div class="px-xxl-5 px-xl-4 px-lg-3">
        <div class="about-inner">
        <p class="fw-bolder h2 text-sm-center mb-4 title">{!! @$settings['first_page_first_title'] !!}</p>
            <div class="title-section mb-sm-5 mb-4 text-sm-center col-xxl-5 col-xl-6 col-lg-7 col-md-12 m-auto p-0">

                <p class="font-th op-lighter short-des">
                      {!! @$settings['first_page_first_text'] !!}
               </p>
            </div>
            @include('layouts.common.branches')
        </div>
    </div>
    @include('layouts.common.slogan-scrollable-animation')
</section>
@push('vue')
    @include('layouts.main.blocks.main-vue',['element_id'=>'about_us_branch'])
@endpush
