<div class="row w-100 m-0">
    @foreach($videos as $video)
        <div class="col-lg-6 col-12 p-2">
            <p class="font-md mb-2 d-flex align-items-center">
                <i class="bi bi-caret-left-fill fs-4 me-1 d-flex color-theme-one"></i>
                بررسی عملکرد {{@$product['title']}}
            </p>
            {!! $video['code'] !!}
{{--            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$video['id']}}">--}}
{{--                <div class="video-tab-item position-relative">--}}
{{--                    <img src="{{asset('assets/site/images/video-cover.jpg')}}" class="w-100" alt="video" title="video" loading="lazy">--}}
{{--                    <!-- Button trigger modal -->--}}
{{--                    <button type="button" class="btn p-0 border-0 ">--}}
{{--                        <i class="bi bi-play-fill d-flex"></i>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </a>--}}

            <!-- Modal -->
{{--            <div class="modal fade" id="exampleModal{{$video['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--                <div class="modal-dialog modal-dialog-centered modal-lg">--}}
{{--                    <div class="modal-content bg-transparent border-0">--}}
{{--                        <div class="modal-header border-0 pb-0">--}}
{{--                            <button type="button" class="btn bg-transparent p-2 text-white border-0 shadow-none text-white" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                                <i class="bi bi-x-lg fs-4 d-flex"></i>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        <div class="modal-body">--}}
{{--                          {!! $video['code'] !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    @endforeach
</div>
