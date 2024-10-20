@extends('layouts.main.master')
@push('styles')
    <link rel="stylesheet" href="{{asset('assets/site/css/samples/list.css?v0.07')}}">
    <style>
        .loading-template .spinner-grow {
            margin: 0 4px;
            width: 1rem;
            height: 1rem;
            background-color: var(--color-dark);
        }
    </style>
@endpush
@section('robots', @$seo_data['noindex'] == 0 ? 'index,follow' : 'noindex,nofollow')
@section('title_seo',@$seo_data['title_seo'] ? @$seo_data['title_seo'] : "نمونه کار")
@section('description_seo',@$seo_data['description_seo'] ? @$seo_data['description_seo'] : "لیست نمونه کار")
@section('content')
    @include('pages.sample-list._partials.header-inner')
    @include('layouts.common.banner-scrollable-animation')
    <section class="list-services mt-5" id="samples" v-cloak>
        <div class="container">
            <div class="row w-100 m-0">
                <!-- filter desktop -->
                <div class="col-xl-3 col-lg-4 p-1 d-lg-block d-none">
                    @include('pages.sample-list._partials.filter')
                </div>
                <!-- filter mobile -->
                <div class="col-12 filter-mobile p-0 d-lg-none d-block">
                    <!-- Button trigger modal -->
                    <button type="button"
                            class="btn btn-one d-flex align-items-center w-100 py-2 px-4 text-center justify-content-center"
                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-sliders2 d-flex me-1"></i>
                        فیلترها
                    </button>

                    {{--filter modal--}}
                    @include('pages.sample-list._partials.modal-filter')
                </div>
                <div class="col-xl-9 col-lg-8 p-1" v-scroll="scroll">
                    <div class="row w-100 m-0">
                        <div class="row w-100 m-0" v-if="isFilter == false">
                            @foreach($samples as $sample)
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 p-1">
                                    <div class="list-card position-relative">
                                        <img src="{{$sample->getImage()}}" class="w-100" alt="{{$sample['title']}}"
                                             title="{{$sample['title']}}" loading="lazy">
                                        <div class="overlay">
                                            <p class="font-md mb-0">
                                                {{$sample['title']}}
                                            </p>
                                            @if ($sample['url'] != null)
                                                <a href="{{ route('portfolio.detail', ['url' => $sample['url']]) }}"
                                                   class="btn btn-two w-100 btn-sm py-2 px-3 mt-1">
                                                    مشاهده جزئیات
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <template v-if="samples.length > 0">
                            <div v-for="sample in samples"
                                 class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 p-1">
                                <div class="list-card position-relative">

                                    <img :src="sample.image" class="w-100" :alt="sample.title" :title="sample.title"
                                         loading="lazy">
                                    <div class="overlay">
                                        <p class="font-md mb-0">
                                            @{{ sample.title }}
                                        </p>
                                        <a :href="sample.url" v-if="sample.url != null"
                                           class="btn btn-two w-100 btn-sm py-2 px-3 mt-1">
                                            مشاهده جزئیات
                                        </a>
                                    </div>

                                </div>

                            </div>
                        </template>
                        <div id="scrollMePlease"></div>

                        <template v-if="stopCall == false">
                            <div class="loading-template d-flex align-items-center justify-content-center">
                                <div class="spinner-grow" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <div class="spinner-grow" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <div class="spinner-grow" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </template>

                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--description--}}
    @include('pages.sample-list._partials.description')
@stop
@push('vue')
    @include('pages.sample-list._partials.vue')
@endpush
