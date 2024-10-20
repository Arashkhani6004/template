@if($product->mainVariant && $product->mainVariant->is_color == 1)
    <p class="font-bold m-0 mt-5 mb-1">انتخاب {{$product->mainVariant->title}} محصول</p>
    <ul class="nav nav-pills mb-5 colors" id="pills-tab" role="tablist">
        <li class="nav-item d-none" role="presentation">
            <button class="nav-link active color-tab" style="background: red;" id="pills-0-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-0" type="button" role="tab" aria-controls="pills-0" aria-selected="true">

            </button>
        </li>
        @foreach($product->variants as $variant)
            <li class="nav-item" role="presentation">
                <button class="nav-link color-tab" style="background: {{$variant->specification->color_code}};"
                        id="pills-{{$variant->id}}-tab" data-bs-toggle="pill" data-bs-target="#pills-{{$variant->id}}"
                        type="button" role="tab" aria-controls="pills-{{$variant->id}}" aria-selected="false"
                        @click="selectVariant({{ json_encode($variant) }})"
                >
                </button>
            </li>
        @endforeach

    </ul>
@endif
