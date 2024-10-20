@if ($sample['description'])
    <section class="seo-box">
        <div class="container">
            <div class="box">
                <div class="boxdes">
                    <input type="checkbox" id="expanded">
                    <div id="text-box" class="p text-start">
                        <p class="h4">
                            {{ $sample['title'] }}
                        </p>
                        <p>
                            {!! $sample['description'] !!}
                        </p>
                    </div>
                    <label for="expanded" id="more-button" role="button" class="btn button btn-one m-auto px-4 py-2 dynamic-color">
                        بیشتر
                    </label>
                </div>
            </div>
        </div>
    </section>
@endif
