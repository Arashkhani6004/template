@if (@$brand['description'] != null)
    <section class="seo-box">
        <div class="container">
            <div class="box">
                <div class="boxdes">
                    <input type="checkbox" id="expanded">
                    <div id="text-box" class="p text-start">
                        {!! @$brand['description'] !!}
                    </div>
                    <label for="expanded" id="more-button" role="button"
                        class="btn button btn-one m-auto px-4 py-2">
                        بیشتر
                    </label>
                </div>
            </div>
        </div>
    </section>
@endif
