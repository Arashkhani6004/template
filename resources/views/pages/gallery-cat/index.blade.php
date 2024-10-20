@extends('layouts.main.master')
@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/gallery/category.css?v0.01')}}">
@endpush
@section('robots', @$seo_data['noindex'] == 0 ? 'index,follow' : 'noindex,nofollow')
@section('title_seo',@$seo_data['title_seo'] ? @$seo_data['title_seo'] : "گالری")
@section('description_seo',@$seo_data['description_seo'] ? @$seo_data['description_seo'] : "گالری تصاویر")
@section('content')
@include('pages.gallery-cat._partials.header-inner')
@include('layouts.common.banner-scrollable-animation')
<section class="gallery category mt-5">
    <div class="container">
        <div class="row w-100 m-0">
            @forelse($gallery_categories as $gallery_category)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 p-lg-2 p-1">
                <div class="cat-inner">
                    <a href="{{ route('gallery.list', ['url' => $gallery_category['url']]) }}">
                        <img src="{{$gallery_category['item_image']}}" class="w-100" alt="{{$gallery_category['title']}}"
                            title="{{$gallery_category['title']}}" loading="lazy">
                        <p class="font-bold my-3 color-title text-center">{{$gallery_category['title']}}</p>
                    </a>
                </div>
            </div>
            @empty
                {{--            //Todo ui : قسمت خالی بودن گالری--}}
            @endforelse
        </div>
    </div>
</section>
@stop
