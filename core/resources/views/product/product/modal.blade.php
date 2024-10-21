<!-- Modal -->
<div class="modal fade" id="exampleModal{{$row['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title fs-5" id="exampleModalLabel">تایمر محصول {{@$row['title']}}</p>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                <form class="w-100 m-0" method="POST" action="{{route('admin.product.timer')}}"
                      enctype="multipart/form-data" id="cms-form" submit.prevent="validateForm" >
                    @csrf
                    <input type="hidden" name="product_id" value="{{@$row['id']}}">
                <div class="row w-100 m-0">

                    <div class="col-md-6 p-1">
                        <input class="form-control form-control-sm mb-2 rounded-custom"
                               type="text" id="datepicker_start{{$row['id']}}" name="start_timer"
                               value="@if(isset($row['start_timer'])){{jdate('d/m/Y',\Carbon\Carbon::parse(@$row->start_timer)->timestamp)}}@endif"
                               placeholder="تاریخ شروع" />

                        <input type="text" class="form-control form-control-sm rounded-custom" name="start_hour"
                               value="@if(isset($row['end_timer'])){{jdate('H:i',\Carbon\Carbon::parse(@$row->start_timer)->timestamp)}}@endif"
                               placeholder="ساعت شروع(مثال:12:00)"/>
                    </div>
                    <div class="col-md-6 p-1">
                        <input class="form-control form-control-sm mb-2 rounded-custom"
                               type="text" id="datepicker_date{{$row['id']}}" name="end_timer"
                               value="@if(isset($row['end_timer'])){{jdate('d/m/Y',\Carbon\Carbon::parse(@$row->end_timer)->timestamp)}}@endif"
                               placeholder="تاریخ پایان" />

                        <input type="text" class="form-control form-control-sm rounded-custom" name="timer_hour"
                               value="@if(isset($row['end_timer'])){{jdate('H:i',\Carbon\Carbon::parse(@$row->end_timer)->timestamp)}}@endif"
                               placeholder="ساعت پایان(مثال:12:00)"/>
                    </div>
                    <div class="form-check border border-custom2 w-fit rounded-custom  rounded-custom p-0 d-flex align-items-center">
                        <input class="form-check-input my-2 ms-2"
                               style="width: 30px; height: 30px;"
                               @if(isset($row) && $row['timer_active'] == 1) checked="checked" @endif
                               value="1"
                               name="timer_active"
                               type="checkbox"
                               role="switch">
                        <label class="form-check-label p-2" for="فعال">
                            فعال
                        </label>


                    </div>
                </div>
                    <button type="submit" class="btn btn-primary rounded-4">ثبت</button>
                </form>
            </div>


        </div>
    </div>
</div>
@push('scripts')
    <script src="{{asset('assets/admin/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/bootstrap-datepicker.fa.min.js')}}"></script>
    <script>
        @foreach($product as $key=>$row)
        $(document).ready(function() {
            $("#datepicker_start{{$row->id}}").datepicker({
                changeMonth: true,
                changeYear: true
            });
            $("#datepicker_date{{$row->id}}").datepicker({
                changeMonth: true,
                changeYear: true
            });
        });
        @endforeach
    </script>
@endpush
