@if(count($fees) > 0)
<section class="price mt-5">
        <div class="container">
            <div
                class="title-section position-relative mb-sm-3 mb-4 text-center col-xxl-5 col-xl-6 col-lg-7 col-md-12 m-auto p-0">
                <p class="fw-bolder h2 mb-2 title">تعرفه و قیمت {{$service['title']}}</p>
            </div>
        </div>
        <section class="price-table">
            <div class="container">
                <div class="header-price">
                    <div class="row w-100 m-0">
                        <div class="col p-1">
                            <div class="">
                                <p class="text-center font-bold m-0">
                                    توضیحات
                                </p>
                            </div>
                        </div>
                        <div class="col p-1">
                            <div class="d-flex align-items-center justify-content-center">
                                <p class="text-center font-bold m-0">
                                    قیمت
                                </p>
                                <span class="font-re font-small mx-1">(تومان)</span>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach( $fees as $fee)
                <div class="price-item">
                    <div class="row w-100 m-0">
                        <div class="col">
                            <p class="font-re  m-0 text-center">
                                {{$fee['description']}}
                            </p>
                        </div>
                        <div class="col">
                            <p class="font-re  m-0 text-center">
                                از {{number_format($fee['minimum_price'])}} تا {{number_format($fee['maximum_price'])}}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </section>
@endif
