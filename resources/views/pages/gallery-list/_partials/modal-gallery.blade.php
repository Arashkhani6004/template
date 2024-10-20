<!-- Modal -->
@foreach($galleries as $gallery)
<div class="modal fade" id="galleryModal{{$gallery['id']}}" tabindex="-1" aria-labelledby="galleryModal{{$gallery['id']}}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <div class="row w-100 m-0">
                            <div class="col-xl-5 col-lg-5 col-5 p-0">
                                <div id="carouselExampleIndicators" class="carousel slide">
{{--                                    <div class="carousel-indicators">--}}
{{--                                        <button type="button" data-bs-target="#carouselExampleIndicators"--}}
{{--                                            data-bs-slide-to="0" class="active" aria-current="true"--}}
{{--                                            aria-label="Slide 1"></button>--}}
{{--                                        <button type="button" data-bs-target="#carouselExampleIndicators"--}}
{{--                                            data-bs-slide-to="1" aria-label="Slide 2"></button>--}}
{{--                                        <button type="button" data-bs-target="#carouselExampleIndicators"--}}
{{--                                            data-bs-slide-to="2" aria-label="Slide 3"></button>--}}
{{--                                    </div>--}}
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="{{$gallery['item_image']}}" class="d-block w-100"
                                                alt="{{$gallery['title']}}" title="{{$gallery['title']}}">
                                        </div>
{{--                                        <div class="carousel-item">--}}
{{--                                            <img src="{{asset('assets/site/images/gallery-cat2.jpg')}}" class="d-block w-100"--}}
{{--                                                alt="gallery-images" title="gallery-images">--}}
{{--                                        </div>--}}
{{--                                        <div class="carousel-item">--}}
{{--                                            <img src="{{asset('assets/site/images/gallery-cat4.jpg')}}" class="d-block w-100"--}}
{{--                                                alt="gallery-images" title="gallery-images">--}}
{{--                                        </div>--}}
                                    </div>
{{--                                    <button class="carousel-control-prev" type="button"--}}
{{--                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">--}}
{{--                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
{{--                                        <span class="visually-hidden">Previous</span>--}}
{{--                                    </button>--}}
{{--                                    <button class="carousel-control-next" type="button"--}}
{{--                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="next">--}}
{{--                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
{{--                                        <span class="visually-hidden">Next</span>--}}
{{--                                    </button>--}}
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-7 col-7 p-0 h-100">
                                <div class="p-2 ">
                                    <div class="gallery-title-modal p-2 border-bottom">
                                        <p class="font-bold mb-0">{{$gallery['title']}}</p>
                                    </div>
                                    <div class="short-description font-re font-small p-2 text-secondary">
                                        <p class="m-0">
                                            {{$gallery['description']}}
                                        </p>
                                    </div>
{{--                                    <div class="related-services-modal mt-2">--}}
{{--                                        <ul class="p-0 m-0 d-flex align-content-center flex-wrap">--}}
{{--                                            <li class="list-unstyled">--}}
{{--                                                <a href="#" class="font-re">--}}
{{--                                                    عروس--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                            <li class="list-unstyled">--}}
{{--                                                <a href="#" class="font-re">--}}
{{--                                                    کاشت ناخن--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endforeach
