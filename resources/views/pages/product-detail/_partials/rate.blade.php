<div class="rate d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center">
        <div class="star-ratings-sprit mb-1">
            <span class="star-ratings-sprit-rating" style="width: {{$rate*20}}%;">
            </span>
        </div>
        <span class="badge font-small font-num color-title ms-2 fw-lighter dynamic-color">
           {{$rate}}
        </span>
        <span class="font-small color-title op-lighter font-num ms-2">
            ({{count($comments)}} نظر )
        </span>
    </div>
{{--  <ul class="p-0 m-0 d-flex align-items-center">--}}
{{--                                    <li class="list-unstyled ms-3">--}}
{{--                                        <a href="">--}}
{{--                                            <i class="bi bi-share text-dark d-flex h5 my-0"></i>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <form action="" method="post" class="m-0">--}}
{{--                                        <li class="float-end list-unstyled ms-3">--}}
{{--                                            <button type="button" id="heart"--}}
{{--                                                class="btn p-0 btn-lg border-0 shadow-none">--}}
{{--                                                <i class="bi bi-suit-heart  d-flex h5 my-0"></i>--}}
{{--                                            </button>--}}
{{--                                        </li>--}}
{{--                                    </form>--}}
{{--                                </ul> --}}
</div>
