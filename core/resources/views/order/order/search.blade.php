<div id="searchModal" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="overflow: unset;">
        <div class="modal-content rounded-custom border-custom shadow bg-white">
            <div class="modal-header px-3 py-2">
                <h4 class="m-0">
                    جستجو
                </h4>
                <button type="button" class="close btn px-0" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg d-flex" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body p-2" style="overflow: unset;">
                <form method="GET" action="{{URL::current()}}" class="m-0">
                    <input type="hidden" name="filter">
                    <div class="row w-100 m-0">
                        <div class="col-lg-4 p-2">
                            <div class="form-group">
                                <x-cms-input
                                    name="id"
                                    label="شماره سفارش"
                                    type="text"
                                />
                            </div>
                        </div>
                        <div class="col-lg-4 p-2">
                            <div class="form-group">
                                <x-cms-input
                                    name="full_name"
                                    label="نام و نام خانوادگی کاربر"
                                    type="text"
                                />
                            </div>
                        </div>
                        <div class="col-lg-4 p-2">
                            <div class="form-group">
                                <x-cms-input
                                    name="mobile"
                                    label="شماره تماس کاربر"
                                    type="text"
                                />
                            </div>
                        </div>
                        <div class="col-lg-4 p-2">
                            <div class="form-group">
                                <x-cms-select
                                    name="shipping_method_id"
                                    label="روش ارسال"
                                    :options="$shipping_methods"
                                    optionValue="id"
                                    optionLabel="title"
                                    :searchable="true"
                                    :selectedOption="null"
                                />
                            </div>
                        </div>
                        <div class="col-lg-4 p-2">
                            <div class="form-group">
                                <x-cms-select
                                    name="shipping_status_id"
                                    label=" وضعیت سفارش"
                                    :options="$shipping_statuses"
                                    optionValue="id"
                                    optionLabel="title"
                                    :searchable="true"
                                    :selectedOption="null"
                                />
                            </div>
                        </div>
                        <div class="col-lg-4 p-2">
                            <div class="form-group">
                                <label>
                                  وضعیت پرداخت
                                </label>
                                <select name="order_status" class="w-100 form-select bg-light rounded-custom " >
                                    <option value="">همه</option>
                                    <option value="paying">در حال پرداخت</option>
                                    <option value="paid">پرداخت شده</option>
                                    <option value="unpaid">پرداخت نشده</option>
                                    <option value="cancelled">لغو شده</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-10 col-12 ms-auto p-2">
                            <button type="submit" class="btn btn-custom rounded-custom w-100">
                                <i class="bi bi-search"></i>
                                جستجو
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
