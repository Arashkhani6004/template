<div class="info-name border-bottom d-flex align-items-center justify-content-between">
    <div class="name d-md-block d-none">
    @include('pages.product-detail._partials.components.info')
    </div>
    @if($brand)
        <div class="brand">
            <a href="{{ route('brand.detail', ['url' => $brand['url']]) }}"
               class="color-title d-flex align-items-start justify-content-end">
                <img src="{{$brand->item_image}}" width="80px" alt="{{@$brand['title']}}" title="{{@$brand['title']}}"
                     loading="lazy">
            </a>
        </div>
    @endif
</div>
