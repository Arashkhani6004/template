@extends('layouts.main.master')
@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/samples/samples.css?v0.02')}}">
@endpush
@section('robots', @$sample->seoIndex == 0 ? 'index,follow' : 'noindex,nofollow')
@section('title_seo',@$sample->seoTitle ? $sample->seoTitle : $sample->title)
@section('description_seo',$sample->seoDescription)
@section('image_seo',$sample->getImage())
@section('content')
@include('pages.sample-detail._partials.header-inner')
@include('layouts.common.banner-scrollable-animation')
<!-- related services -->
@include('pages.sample-detail._partials.related-services')

<!-- seo box -->
@include('pages.sample-detail._partials.description')

<!-- related blogs -->
@include('pages.sample-detail._partials.related-blog')

<!-- comments -->
@include('layouts.common.comment.comments',['commentable_id'=>$sample['id'],'commentable_type'=>get_class($sample)])

@stop
@push('scripts')
<script src="{{asset('assets/site/js/samples/sample.js?v0.01')}}"></script>
@endpush
