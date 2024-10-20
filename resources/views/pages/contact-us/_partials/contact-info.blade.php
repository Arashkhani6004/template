<div class="contact-info">
                    <p class="h5 mb-5 font-bold">{{$settings['phone_call']}}</p>
                    <ul class="p-0 m-0 info">
                        <li class="list-unstyled">
                            <a href="tel:{{$settings['main_phone_number']}}" class="d-flex align-items-center text-dark">
                                <img src="{{asset('assets/site/images/tel-dark-icon.svg')}}" class="me-2" width="25" height="25"
                                    loading="lazy" alt="tel">
                                <div class="">
                                    <p class="font-th small mb-0">
                                        تلفن جهت رزرو
                                    </p>
                                    <p class="m-0" dir="ltr">
                                        @toPersianNumber($settings['main_phone_number'])
                                    </p>
                                </div>
                            </a>
                        </li>
                        <li class="list-unstyled">
                            {{--TODO ui : جدا کردن متن از شماره--}}
                            @foreach($settings['phone_numbers'] as $phone)
                            <a href="tel:{{$phone}}" class="d-flex align-items-center text-dark">
                                <i class="bi bi-headset d-flex fs-3 me-2"></i>
                                <div class="">
                                    <p class="font-th small mb-0">
                                        ارتباط با پشتیبانی
                                    </p>
                                    <p class="m-0" dir="ltr">
                                        @toPersianNumber($phone)
                                    </p>
                                </div>
                            </a>
                            @endforeach
                        </li>
                        <li class="list-unstyled">
                            <a href="mailto:{{$settings['email']}}" class="d-flex align-items-center text-dark">
                                <img src="{{asset('assets/site/images/tel-dark-icon.svg')}}" class="me-2" width="25" height="25"
                                     loading="lazy" alt="tel">
                                <div class="">
                                    <p class="font-th small mb-0">
                                        ایمیل جهت رزرو
                                    </p>
{{--TODO ui : svg ایمیل--}}
                                    <p class="m-0" dir="ltr">
                                        {{$settings['email']}}
                                    </p>
                                </div>
                            </a>
                        </li>
{{--                        <li class="list-unstyled">--}}
{{--                            <a href="#" class="d-flex align-items-center text-dark">--}}
{{--                                <i class="bi bi-geo-alt-fill d-flex fs-3 me-2"></i>--}}
{{--                                <div class="">--}}
{{--                                    <p class="font-th small mb-0">--}}
{{--                                        آدرس--}}
{{--                                    </p>--}}
{{--                                    <p class="m-0" dir="ltr">--}}
{{--                                        {{$settings['address']}}--}}
{{--                                    </p>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                        <li class="list-unstyled d-flex align-items-center text-dark">
                            <i class="bi bi-chat-left-quote-fill d-flex fs-3 me-3"></i>
                            <div class="">
                                <p class="font-th small mb-2">
                                    ما را در شبکه های اجتماعی دنبال کنید
                                </p>
                                <ul class="p-0 m-0 d-flex align-items-center">
                                    @foreach($socials as $social)
                                    <li class="me-4 mb-0">
                                        <a href="{!! $social['link'] !!}" rel="nofollow">
                                            <i class="bi bi-{{$social['icon']}} fs-4 d-flex "></i>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
