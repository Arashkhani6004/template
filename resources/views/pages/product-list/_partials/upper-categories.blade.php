@if(count($children) > 0)
    <!-- categories -->
    <div class="col-12 p-1 mb-2">
        <div class="swiper swiper-categories">
            <div class="swiper-wrapper py-2">
                @foreach($children as $child)
                    <div class="swiper-slide">
                        <div class="cat-card">
                            <a href="{{ route('category.detail', ['url' => @$child['url']]) }}"
                               class="h-rotate color-title">
                                <div class="name-cat">
                                    <p class="font-md mb-1">
                                        {{@$child['title']}}
                                    </p>
                                    @if(@$child['product_counts'] != 0)
                                        <p class="font-num-r mb-3">
                                            {{@$child['product_counts']}} محصول
                                        </p>
                                    @endif
                                </div>
                                <div class="img-cat">
                                    <img src="{{@$child->getImage('medium')}}" alt="{{@$child['title']}}"
                                         title="{{@$child['title']}}" loading="lazy">
                                </div>

                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
