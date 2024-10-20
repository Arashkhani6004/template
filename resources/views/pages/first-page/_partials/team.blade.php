@if(count($team_members) > 0)
    <section class="team">
        <div class="container">
            <div
                class="title-section position-relative mb-sm-5 mb-4 text-center col-xxl-5 col-xl-6 col-lg-7 col-md-12 m-auto p-0">
                <p class="fw-bolder h2 mb-4 title"> {!! @$settings['first_page_team_title'] !!}</p>
                <p class="font-re short-des">
                    {!! @$settings['first_page_team_text'] !!}
                </p>
            </div>
        </div>
        {{--Todo ui : دیتای داخل المنت روی اندازه اش تاثیر میزاره : Done--}}
        <div class="swiper swiper-team">
            <div class="swiper-wrapper justify-content-md-center py-5">
                @foreach($team_members as $row)
                    <div class="swiper-slide">
                        <div class="team-card">
                            <img src="{{$row->getAvatar()}}" class="team-img" alt="{{$row['full_name']}}"
                                 title="{{$row['full_name']}}" loading="lazy">
                            <div class="information mt-4">
                                <p class="name text-center font-re mb-1 ">
                                    {{$row['full_name']}}
                                </p>
                                @if($row['mobile'])
                                <a href="{{"tel:".$row['mobile']}}" class="text-black expert text-center small font-re mb-0">
                                    {{$row['mobile']}}
                                </a>
                                @endif
                                <p class="expert text-center small font-re mb-0">
                                    @foreach($row['services'] as $team_service)
                                        {!! $team_service['title'] !!}
                                        @if (!$loop->last)
                                            ،
                                        @endif
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
