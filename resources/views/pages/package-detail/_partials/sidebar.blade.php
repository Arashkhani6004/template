<div class="sticky-sidebar">
    <div class="img-package d-lg-block d-none">
        <img src="{{$package->getImage()}}" alt="{{$package['title']}}" title="{{$package['title']}}" class="w-100"
            loading="lazy">
    </div>
    @if(count($package['services'])) @endif

    <div class="services-within mt-3 mb-lg-0 mb-4">
        <p class="font-bold color-title fs-5 mb-2">خدمات پکیج</p>
        <ul class="p-0 m-0 d-flex align-items-center flex-wrap">
            @foreach($package['services'] as $package_service)
            <li class="service-item list-unstyled">
                {{$package_service['title']}}
            </li>
            @endforeach
        </ul>
    </div>

    {{--package-price-desktop--}}
    <div class="d-lg-block d-none">
        @include('pages.package-detail._partials.package-price')
    </div>
</div>
