<div class="modal fade" id="exampleModal{{$comment['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 p-0">
                <button type="button" class="btn bg-transparent border-0 ms-auto shadow-none" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg fs-4 text-light"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('post-comment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="commentable_id" value="{{$commentable_id}}">
                    <input type="hidden" name="commentable_type" value="{{$commentable_type}}">
                    <input type="hidden" name="status" value="0">
                    <input type="hidden" name="reply_id" value="{{$comment['id']}}">
                    <div class="comment-form ">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label small mb-1 font-th dynamic-color">نام و نام خانوادگی</label>
                            <input type="text" class="form-control dynamic-color" id="exampleFormControlInput1" placeholder="نام خود را بنویسید" name="name"
                                   required oninvalid="warnRequired(' نام ونام خانوادگی')">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label small mb-1 font-th dynamic-color">شماره همراه</label>
                            <input type="text" class="form-control dynamic-color" id="mobile" placeholder="شماره همراه خود را بنویسید" name="mobile"
                                   required oninvalid="warnRequired(' شماره تماس')"
                                   onchange="checkMobile(event)">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label small mb-1 font-th dynamic-color">نظر</label>
                            <textarea class="form-control dynamic-color" id="exampleFormControlTextarea1" rows="3" name="content"
                                      required oninvalid="warnRequired(' متن نظر')"></textarea>
                        </div>
                        <button type="submit" class="btn btn-form font-th position-relative">ثبت</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
