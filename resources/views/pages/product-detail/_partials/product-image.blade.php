<div class="product-image">
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-0" role="tabpanel" aria-labelledby="pills-0-tab" tabindex="0">
            <div class="app-figure" id="zoom-fig">
                <a id="Zoom-0" class="MagicZoom d-flex justify-content-center align-items-center image-large"
                    href="{{$product->getImage('medium')}}"
                    data-zoom-image-2x="{{$product->getImage('big')}}" data-image-2x="{{$product->getImage('big')}}">
                    <img src="{{$product->getImage('big')}}" srcset="{{$product->getImage('medium')}} 2x" alt="{{$product['title']}}"
                        title="{{$product['title']}}" width="100%" />
                </a>
                <div class="selector mt-3">
                    <div class="swiper swiper-selector">
                        <div class="swiper-wrapper">
                            @foreach($images as $row)
                            <div class="swiper-slide">
                                <button class="selector-item w-100 p-0" data-zoom-id="Zoom-0" href="{{$row['image_big']}}"
                                    data-image="{{$row['image_big']}}" data-zoom-image-2x="{{$row['image_big']}}"
                                    data-image-2x="{{$row['image_big']}}">
                                    <img class="p-0" srcset="{{$row['image_small']}} 2x" src="{{$row['image_small']}}"
                                        width="100%" alt="{{$product['title']}}" title="{{$product['title']}}" />
                                </button>
                            </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>

                </div>
            </div>
        </div>
        @foreach($product->variants as $variant)
        <div class="tab-pane fade" id="pills-{{$variant->id}}" role="tabpanel" aria-labelledby="pills-{{$variant->id}}-tab" tabindex="0">
            <div class="app-figure" id="zoom-fig">
                <a id="Zoom-{{$variant->id}}" class="MagicZoom d-flex justify-content-center align-items-center image-large"
                   href="{{@Rahweb\CmsCore\Modules\Product\Services\VariantService::getProductImagesSizeSeperated($variant->images)[0]['image_medium'] ?? '/assets/notfounds/product-img.jpg'}}"
                   data-zoom-image-2x="{{@Rahweb\CmsCore\Modules\Product\Services\VariantService::getProductImagesSizeSeperated($variant->images)[0]['image_big'] ?? '/assets/notfounds/product-img.jpg'}}"
                   data-image-2x="{{@Rahweb\CmsCore\Modules\Product\Services\VariantService::getProductImagesSizeSeperated($variant->images)[0]['image_big'] ?? '/assets/notfounds/product-img.jpg'}}">
                    <img src="{{@Rahweb\CmsCore\Modules\Product\Services\VariantService::getProductImagesSizeSeperated($variant->images)[0]['image_big'] ?? '/assets/notfounds/product-img.jpg'}}"
                         srcset="{{@Rahweb\CmsCore\Modules\Product\Services\VariantService::getProductImagesSizeSeperated($variant->images)[0]['image_medium'] ?? '/assets/notfounds/product-img.jpg'}} 2x" alt="{{$product['title']}}"
                         title="{{$product['title']}}" width="100%" />
                </a>
                <div class="selector mt-3">
                    <div class="swiper swiper-selector">
                        <div class="swiper-wrapper">
                            @foreach(Rahweb\CmsCore\Modules\Product\Services\VariantService::getProductImagesSizeSeperated($variant->images) as $row2)
                                <div class="swiper-slide">
                                    <button class="selector-item w-100 p-0" data-zoom-id="Zoom-{{$variant->id}}" href="{{$row2['image_big']}}"
                                            data-image="{{$row2['image_big']}}" data-zoom-image-2x="{{$row2['image_big']}}"
                                            data-image-2x="{{$row2['image_big']}}">
                                        <img class="p-0" srcset="{{$row2['image_small']}} 2x" src="{{$row2['image_small']}}"
                                             width="100%" alt="{{$product['title']}}" title="{{$product['title']}}" />
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>

                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
