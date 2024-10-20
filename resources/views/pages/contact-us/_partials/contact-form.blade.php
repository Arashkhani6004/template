<div class="contact-form">
                    <form action="{{ route('us.post-contact') }}" method="POST">
                        @csrf
                        <div class="input-box">
                            <input type="text" placeholder="نام ونام خانوادگی" name="name" required oninvalid="warnRequired(' نام ونام خانوادگی')"
                                class="form-control border-0 shadow-none">
                        </div>
                        <div class="input-box">
                            <input type="text" dir="rtl" placeholder="شماره تماس" name="mobile" id="mobile" required oninvalid="warnRequired(' شماره تماس')"
                             onchange="checkMobile(event)"
                                class="form-control border-0 shadow-none">
                        </div>
                        <div class="input-box">
                            <input type="text" placeholder="عنوان پیام" class="form-control border-0 shadow-none" name="title" required oninvalid="warnRequired(' عنوان پیام')">
                        </div>
                        <div class="input-box">
                            <textarea placeholder="متن پیام" class="form-control border-0 shadow-none" name="message" required oninvalid="warnRequired(' متن پیام')"
                                rows="3"></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-one px-5 py-2 dynamic-color">ثبت</button>
                        </div>
                    </form>
                </div>
@include('layouts.common.sweetalert')
@push('scripts')


    <script src="{{asset('assets/site/js/validate.js')}}"></script>

@endpush
