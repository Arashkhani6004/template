@if(count($related_blogs) > 0)
<div class="related-blog mt-4 ">
                        <p class="font-bold color-title mb-2">مطالب مرتبط</p>
                        <ul class="p-0 m-0">
                          @foreach($related_blogs as $related_blog)
                            <li class="list-unstyled related-item">
                                <a href="{{ route('blog.detail', ['url' => $related_blog['url']]) }}" class="row w-100 m-0">
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-3 p-1 ">
                                        <img src="{{$related_blog['item_image']}}" alt="{{$related_blog['title']}}"
                                            title="{{$related_blog['title']}}" loading="lazy" class="w-100">
                                    </div>
                                    <div class="col-xl-8 col-lg-8 col-md-12 col-9 p-1 align-self-center">
                                        <p class="m-0 small font-re color-title">
                                            {{$related_blog['title']}}
                                        </p>
                                        <small class="date font-re"> {{jdate('l j F Y',strtotime($related_blog['publish_date']))}}</small>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
@endif
