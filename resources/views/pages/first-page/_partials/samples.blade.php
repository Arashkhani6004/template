@if(count($samples) > 0)
    <section class="samples overflow-hidden position-relative">
        <div class="container">
            <div class="title-section mb-sm-5 mb-4 text-center col-xxl-5 col-xl-6 col-lg-7 col-md-12 m-auto p-0">
                <p class="fw-bolder h2 mb-4 title"> {!! @$settings['first_page_sample_title'] !!}</p>
            </div>
            <div class="samples-inn">
                <div class="row w-100 m-0 h-100">
                    <div class="col h-100 d-flex flex-column p-0 flex-wrap">
                        {{-- Todo ui : dont use background image--}}

                        @foreach($samples as $key => $sample)
                            {{--Review : add href--}}
                            <a href="{{$sample['url']}}" class="item item{{@$key+1}}" style="background-image: url('{{@$sample->getImage('medium')}}');"></a>
                        @endforeach
                    </div>
                </div>
                <div class="overlay d-flex align-items-end justify-content-center">
                    {{--Review : add href--}}
                    <a href="{{{route('portfolio.list')}}}" class="btn-arrow d-flex justify-content-between h-rotate d-md-flex d-none">
                        {!! @$settings['sample_button'] !!}
                        <span class="arrow-box">
                            <i class="bi bi-arrow-up-left d-flex fs-5 main-icon dynamic-color"></i>
                        </span>
                    </a>
                </div>
            </div>
            {{--Review : add href--}}
            <a href="{{{route('portfolio.list')}}}" class="btn-arrow d-flex justify-content-between h-rotate d-md-none d-flex">
                {!! @$settings['sample_button'] !!}
                <span class="arrow-box">
                <i class="bi bi-arrow-up-left d-flex fs-5 main-icon dynamic-color"></i>
                </span>
            </a>
        </div>
        <div class="banner-scrollable overflow-hidden d-flex flex-nowrap">
            @if(@$settings['first_page_sample_text'])
                <div class="scroll-text">
                    <ul class="m-0 p-0 d-flex align-items-center justify-content-center fa" dir="ltr">
                        @foreach($settings['first_page_sample_text'] as $text)
                            <li class="dynamic-color"> {{$text}} </li>
                        @endforeach
                    </ul>
                </div>
                <div class="scroll-text">
                    <ul class="m-0 p-0 d-flex align-items-center justify-content-center fa" dir="ltr">
                        @foreach($settings['first_page_sample_text'] as $text)
                            <li class="dynamic-color"> {{$text}} </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </section>
@endif
