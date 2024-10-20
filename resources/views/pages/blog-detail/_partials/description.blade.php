<div class="description-box position-relative">
    @if($blog['call_to_action'] == 1)
    <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-10  p-0 m-auto">
        <a href="tel:{{$settings['main_phone_number']}}" class="btn-arrow-two d-flex justify-content-between py-4 mb-3 h-rotate dynamic-color">
            <div class="d-flex align-items-center">
                <i class="bi bi-telephone-fill d-flex fs-5 m-10-l "></i>
                <div>
                    <p class="mb-0 font-th text-start" dir="ltr">تماس با کارشناسان </p>
                </div>
            </div>
            <span class="arrow-box m-0">
                <img src="{{asset('assets/site/images/left-top-arrow-dark.svg')}}" class="main-icon"
                    width="25" height="25" alt="arrow-icon" title="arrow-icon" loading="lazy">
            </span>
        </a>
    </div>
    @endif
    <div class="box position-relative">
        <div class="title">
            <p class="h3">
                {{$blog['title']}}
            </p>
        </div>
        <div class="content">
            <p>
                {!! $blog['description'] !!}
            </p>
        </div>
    </div>
    @if($blog['call_to_action'] == 1)
    <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-10  p-0 m-auto">
        <a href="tel:{{$settings['main_phone_number']}}" class="btn-arrow-two d-flex justify-content-between py-4 mb-3 h-rotate dynamic-color">
            <div class="d-flex align-items-center">
                <i class="bi bi-telephone-fill d-flex fs-5 m-10-l "></i>
                <div>
                    <p class="mb-0 font-th text-start" dir="ltr">تماس با کارشناسان </p>
                </div>
            </div>
            <span class="arrow-box m-0">
                <img src="{{asset('assets/site/images/left-top-arrow-dark.svg')}}" class="main-icon"
                    width="25" height="25" alt="arrow-icon" title="arrow-icon" loading="lazy">
            </span>
        </a>
    </div>
    @endif
</div>