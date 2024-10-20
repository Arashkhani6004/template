<div class="description-box position-relative">
    <div class="box position-relative">
        <div class="title">
            <p class="h3">
                {{$package['title']}}
            </p>
        </div>
        <div class="content">
       {!! $package['description'] !!}
        </div>

    </div>
    <div class="col-xxl-7 col-xl-7 col-lg-8 col-md-10  p-0 m-auto">
        <a href="tel:{{$settings['main_phone_number']}}" class="btn-arrow-two d-flex justify-content-between py-4 mb-5 h-rotate">
            <div class="d-flex align-items-center">
                <img src="{{asset('assets/site/images/tel-dark-icon.svg')}}" class="m-10-l" width="25" height="25"
                    alt="call" title="call">
                <div>
                    <p class="mb-0 font-th text-start" dir="ltr">تماس با کارشناسان</p>
                </div>
            </div>
            <span class="arrow-box m-0">
                <img src="{{asset('assets/site/images/left-top-arrow-dark.svg')}}" class="main-icon" width="25"
                    height="25" alt="arrow-icon" title="arrow-icon" loading="lazy">
            </span>
        </a>
    </div>
</div>
