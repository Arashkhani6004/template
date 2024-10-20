@extends('pages.panel.master')
@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/panel/panel.css?v.1')}}">
@endpush
@section('content')
<div class="header p-3">
    <p class="font-md m-0 d-flex align-items-center h3">
        <i class="bi bi-mailbox me-2 d-flex"></i>
        عنوان تستی تیکت شماره یک
    </p>
</div>
<div class="content px-xl-3 py-2">
    <ul class="chat-history list-unstyled mb-0 py-3 flex-grow-1">
        <li id="youReply1" class="mb-3 d-flex flex-row-reverse align-items-end">
            <div class="max-width-70 text-end">
                <div class="user-info mb-1 d-flex align-items-end justify-content-end">
                    <span class="text-muted font-small"> نام کاربر</span>
                    <img src="{{asset('assets/site/images/people.png')}}" alt="user" width="30" height="30" class="ms-2 img-you">
                </div>
                <div class="card border-0 py-2 px-3 bg-you text-dark you shadow-sm">
                    <div class="message font-re small">
                        <div class="mb-1 messege-text">
                            این یک پیام تستی از طرف ادمین برای پاسخ به کاربر است
                        </div>
                    </div>
                    <div class="files d-flex align-items-center gap-1 flex-wrap justify-content-end">
                        <a href="#" class="file-item d-flex align-items-center font-th">
                            <i class="bi bi-paperclip d-flex"></i>
                            دانلود ضمیمه۱</a>
                    </div>
                </div>
                <div class="user-info mt-1 d-flex align-items-end justify-content-start"><span class="text-dark font-small font-th font-num">12 خرداد 15:26 </span></div>
            </div>
        </li>
        <li id="meReply1" class="mb-3 d-flex flex-row align-items-end">
            <div class="max-width-70">
                <div class="user-info mb-1 d-flex align-items-end justify-content-start">
                    <img src="{{asset('assets/site/images/people.png')}}" alt="admin" width="30" height="30" class="me-2 img-me">
                    <span class="text-muted small ms-1">ادمین</span>
                </div>
                <div class="card border-0 py-2 px-3 bg-me shadow-sm">
                    <div class="message font-re small">
                        <div class="mb-1 messege-text">
                            این یک پیام تستی از طرف ادمین برای پاسخ به کاربر است
                        </div>
                    </div>
                    <div class="files d-flex align-items-center gap-1 flex-wrap justify-content-start">
                        <a href="#" class="file-item d-flex align-items-center font-th">
                            <i class="bi bi-paperclip d-flex"></i>
                            دانلود ضمیمه۱</a>
                        <a href="#" class="file-item d-flex align-items-center font-th">
                            <i class="bi bi-paperclip d-flex"></i>
                            دانلود ضمیمه۱</a>
                    </div>
                </div>
                <div class="user-info mt-1 d-flex align-items-center justify-content-end"><span class="text-dark font-small font-num">9 خرداد 16:54 </span></div>
            </div>
        </li>

    </ul>
    <div class="form-message">
        <form class="row w-100 m-0 shadow rounded-4 overflow-hidden">
            <div class="col-sm-1 col-2 p-0">
                <div class="input-group frm">
                    <label for="inputGroupFile01" class="input-group-text w-100 rounded-0" style="height: 66px; cursor: pointer;">
                        <i class="bi bi-paperclip d-flex mx-auto h3 my-0"></i>
                    </label>
                    <input name="files[]" multiple="multiple" type="file" id="inputGroupFile01" class="form-control rounded-0 d-none">
                </div>
            </div>
            <div class="col-sm-10 col-8 p-0">
                <textarea name="message" id="message" cols="30" rows="1" placeholder="پیام خود را بنویسید ..." class="form-control  w-100 rounded-0" style="height: 100%;">
                                    </textarea>
            </div>
            <div class="col-sm-1 col-2 p-0">
                <button type="button" class="btn  send position-relative rounded-0 d-flex align-items-center justify-content-center w-100 h-100">
                    <i class="bi bi-send text-custom-b d-flex h3 my-0"></i>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection