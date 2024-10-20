@include('pages.product-detail._partials.tags')
@if($product['description'] != null)
<div class="description">
    {!! @$product['description'] !!}
</div>
@else
<div class="description">
    {{-- //Todo: empty for desc--}}
    <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-5 col-sm-6 col-5 p-0 m-auto align-self-center text-center">
        <img src="{{asset('assets/site/images/empty-states/description-empty.png')}}" class="w-100" alt="empty-state" title="empty-state" loading="lazy">
    </div>
    <p class="font-md mb-0 mt-3 text-center">
        توضیحاتی موجود نیست!
    </p>
</div>
@endif