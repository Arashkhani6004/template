@extends('pages.panel.master')
@section('address','active')
@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/panel/panel.css?v.1')}}">
@endpush
@section('content')
<div class="header p-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
    <p class="font-md m-0 d-flex align-items-center h3">
        <i class="bi bi-map me-2 d-flex"></i>
        آدرس ها
    </p>
    <!-- Button for new address modal -->
    <button type="button" class="btn btn-one py-2 px-3 d-flex align-items-center dynamic-color" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="bi bi-plus d-flex me-1"></i>
        افزودن آدرس جدید
    </button>
</div>
<div class="content px-xl-3 py-2" id="app">
    <div class="addresses">
        <div class="row w-100 m-0">
            <div class="col-sm-12 p-1"  v-for="(location, index) in locations" :key="location.id">
                <div class="address-item p-2 border">
                    <div class="d-flex align-items-center justify-content-between">
{{--                        <div class="form-check">--}}
{{--                            <input class="form-check-input" type="radio" name="address_id"--}}
{{--                                   v-model="defaultAddressId"--}}
{{--                                   @change="getShippingMethod()"--}}
{{--                                   :checked="location.id == defaultAddressId"--}}
{{--                                   :id="'flexCheckDefault'+ location.id" :value="location.id">--}}
{{--                            <label class="form-check-label small font-th" :for="'flexCheckDefault'+ location.id">--}}
{{--                                آدرس پیشفرض--}}
{{--                            </label>--}}
{{--                        </div>--}}
                        <a @click="editAddress(location.id)" class="color-title d-flex align-items-center font-small font-re" data-bs-toggle="collapse" :href="'#editAdress-' + location.id" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="bi bi-pencil d-flex me-1"></i>
                            ویرایش
                        </a>
                    </div>
                    <p class="font-md m-0 mt-2">

                        @{{ location.state_name }}
                        |
                        @{{ location.city_name }}
                    </p>
                    <p class="font-th m-0 small mt-1">
                        @{{ location.address }}
                    </p>
                    <div class="collapse mt-2" :id="'editAdress-' + location.id">
                        <div class="card card-body p-2 edit-card">
                            @include('pages.panel.addresses._partials.edit-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- add adress modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-add">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title fs-5" id="exampleModalLabel">افزودن آدرس جدید</p>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    @include('pages.panel.addresses._partials.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
    <script src="{{asset('assets/site/js/sweetalert2.all.min.js')}}"></script>
@endpush
@push('vue')
    @include('pages.panel.addresses._partials.vue')
@endpush
