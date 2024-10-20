<section class="comments">
    <div class="container">
        <div
            class="title-section position-relative mb-sm-5 mb-4 text-center col-xxl-5 col-xl-6 col-lg-7 col-md-12 m-auto p-0">
            <p class="fw-bolder h2 mb-4 title">نظرات کاربران</p>
        </div>
            @include('layouts.common.comment._partials.comment-base')
    </div>
</section>
@push('scripts')
    <script src="{{asset('assets/site/js/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('assets/site/js/validate.js')}}"></script>
@endpush
