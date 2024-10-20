@extends('pages.panel.master')
@section('profile','active')
@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/panel/panel.css?v.1')}}">
@endpush
@section('content')
<div class="header p-3">
    <p class="font-md m-0 d-flex align-items-center h3">
        <i class="bi bi-pencil-square me-2 d-flex"></i>
        ویرایش اطلاعات
    </p>
</div>
<div class="content px-xl-3 py-2" id ="app">
    <div class="edit-info">
        <div class="login-form">
            <form action="{{route('panel.edit-profile')}}" method="POST">
                @csrf
                <div class="row w-100 m-0">
                    <div class="col-6 p-1 mb-2">
                        <label for="name" class="form-label font-small font-re mb-1">نام و نام خانوادگی</label>
                        <div class="position-relative">
                            <input type="text" class="form-control" name="full_name" ref="full_name" readonly id="full_name" value="{{\Illuminate\Support\Facades\Auth::user()->full_name}}">
                            <button type="button" id="editButton" @click="changeState('full_name')" class="btn btn-edit font-re btn-sm">
                                <i v-if="isReadonlyfull_name" class="bi bi-pencil d-flex"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-6 p-1 mb-2">
                        <label for="mobile" class="form-label font-small font-re mb-1">شماره همراه</label>
                        <div class="position-relative">
                            <input
                                onchange="checkMobile(event)"
                                type="text" name="mobile" ref="mobile" class="form-control text-start" readonly id="mobile" value="{{\Illuminate\Support\Facades\Auth::user()->mobile}}" >
                            <button type="button" id="editButton" @click="changeState('mobile')" class="btn btn-edit font-re btn-sm">
                                <i v-if="isReadonlymobile"  class="bi bi-pencil d-flex"></i>
                            </button>
                        </div>
                    </div>
                    @php
                        $date = [];
                        if (isset(\Illuminate\Support\Facades\Auth::user()->birthday)){

                              $x = \App\Library\NumberHelper::persian2LatinDigit(jdate('Y-m-d',Carbon\Carbon::parse(\Illuminate\Support\Facades\Auth::user()->birthday)->timestamp));
                              $date = explode('-',$x);

                        }
                    @endphp
                    <div class="col-12 p-1 mb-2">
                        <label for="name" class="form-label font-small font-re mb-1">تاریخ تولد</label>
                        <div class="position-relative">
                            <div class="row w-100 m-0">
                                <div class="col-4 p-1 position-relative">
                                    <select name="year" class="form-select" aria-label="Default select example" disabled ref="year" id="year">
                                        <option value="">سال</option>
                                        @foreach($years as $key => $year)
                                            <option value="{{ $year }}"
                                                    @if(isset(\Illuminate\Support\Facades\Auth::user()->birthday) and $date[0]==$year)
                                                        selected
                                                @endif
                                            >{{ $year }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" id="editButton" @click="changeState('year')" class="btn btn-edit font-re btn-sm">
                                        <i v-if="isDisabledyear"  class="bi bi-pencil d-flex"></i>
                                    </button>
                                </div>
                                <div class="col-4 p-1 position-relative">
                                    <select name="month" class="form-select" v-model="selectedMonth" aria-label="Default select example"
                                            @change="changeMonth(selectedMonth)" disabled ref="month" id="month">
                                        <option value="">ماه</option>
                                        @foreach($months as $monthNumber => $monthInfo)
                                            <option value="{{ $monthNumber }}"
                                                    @if(isset(\Illuminate\Support\Facades\Auth::user()->birthday) and $date[1]==$monthNumber)
                                                        selected
                                                @endif
                                            >{{ $monthInfo['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" id="editButton" @click="changeState('month')" class="btn btn-edit font-re btn-sm">
                                        <i v-if="isDisabledmonth"  class="bi bi-pencil d-flex"></i>
                                    </button>
                                </div>
                                <div class="col-4 p-1 position-relative">
                                    <select name="day" class="form-select" aria-label="Default select example" v-model="selectedDay"
                                            disabled ref="day" id="day">
                                        <option value="">روز</option>
                                        <option v-for="day in daysInMonth" :key="day" :value="day">@{{ day }}</option>
                                    </select>
                                    <button type="button" id="editButton" @click="changeState('day')" class="btn btn-edit font-re btn-sm">
                                        <i v-if="isDisabledday"  class="bi bi-pencil d-flex"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="bt btn-one mt-2 m-auto py-3 d-block dynamic-color">ثبت تغییرات</button>
            </form>
        </div>
    </div>
</div>
@include('layouts.common.sweetalert')
@endsection
@push('styles')
    <script src="{{asset('assets/site/js/sweetalert2.all.min.js')}}"></script>
@endpush
@push('scripts')
<script src="{{asset('assets/site/js/panel/panel.js')}}"></script>
<script src="{{asset('assets/site/js/validate.js')}}"></script>
<script>
    var monthsData = @json($months);
</script>
@endpush
@push('vue')
    @include('pages.panel.edit-information._partials.vue')
@endpush
