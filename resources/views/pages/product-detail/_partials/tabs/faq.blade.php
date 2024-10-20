<p class="font-bold">
    سوالات متداول {{@$product['title']}}
</p>
<div class="accordion faq-section" id="accordionExample">
    @foreach($faqs as $faq)
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$faq['id']}}" aria-expanded="false" aria-controls="collapse{{$faq['id']}}">
                {!! $faq['question'] !!}
            </button>
        </h2>
        <div id="collapse{{$faq['id']}}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                {!! $faq['answer'] !!}
            </div>
        </div>
    </div>
    @endforeach
</div>
