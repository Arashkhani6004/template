@extends('layouts.main.master')
@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/gallery/category.css?v0.01')}}">
@endpush
@section('robots', @$gallery_category->seoIndex == 0 ? 'index,follow' : 'noindex,nofollow')
@section('title_seo',@$gallery_category->seoTitle ? $gallery_category->seoTitle : $gallery_category->title)
@section('description_seo',@$gallery_category->seoDescription)
@section('image_seo',@$gallery_category->item_image)
@section('content')
@include('pages.gallery-list._partials.header-inner')
@include('layouts.common.banner-scrollable-animation')

<section class="gallery category mt-5">
    <div class="container">
        <div class="row w-100 m-0">
            @forelse($galleries as $gallery)
            <div class="col-xl-3 col-lg-4 col-md-6 col-6 p-lg-2 p-1">
                <div class="cat-inner">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#galleryModal{{$gallery['id']}}">
                        <img src="{{$gallery['item_image']}}" class="w-100" alt="{{$gallery['title']}}"
                            title="{{$gallery['title']}}" loading="lazy" />
                        <p class="font-bold my-3 color-title text-center">
                            {{$gallery['title']}}
                        </p>
                    </a>
                </div>
            </div>
            @empty
                {{--            //Todo ui : قسمت خالی بودن گالری--}}
            @endforelse
        </div>

        @include('pages.gallery-list._partials.modal-gallery')
    </div>
</section>
@stop
