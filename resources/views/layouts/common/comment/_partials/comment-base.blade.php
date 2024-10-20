<div class="row w-100 m-0">
    <div class="col-xl-3 col-lg-4 col-md-5 p-1 pe-lg-2">
        @include('layouts.common.comment._partials.comment-form')
    </div>
    <div class="col-xl-9 col-lg-8 col-md-7 p-1 ps-lg-2">
        @forelse($comments as $comment)
            @include('layouts.common.comment._partials.main-comment')
            @include('layouts.common.comment._partials.reply-comment')

            <!-- reply form modal -->
            @include('layouts.common.comment._partials.reply-modal')
        @empty
            <div class="col-xxl-3 col-xl-4 col-lg-5 col-md6 col-sm-7 col-6 p-0 m-auto align-self-center text-center">
                <img src="{{asset('assets/site/images/empty-states/message_empty.png')}}" class="w-100" alt="empty-state" title="empty-state" loading="lazy">
            </div>
            <p class="font-md mb-0 mt-3 text-center">
                هنوز هیچ کامنتی ثبت نشده است
            </p>
            <p class="font-th small mb-0 text-center">
                اولین نفری باشید که نظر خود را بیان می‌کند!
            </p>
        @endforelse
    </div>
</div>
