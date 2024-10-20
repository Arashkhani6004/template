{{--Todo ui : اگر اینجا متن فارسی بزارن خیلی بد میشه ظاهرش--}}
@if(isset($settings['first_page_first_animation']))
<div class="slogan-scrollable d-lg-block d-none">
    <div class="scroll-text">
        <p class="m-0"> {!! @$settings['first_page_first_animation'] !!}</p>
    </div>
</div>
@endif
