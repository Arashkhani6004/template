<section class="banner-scrollable overflow-hidden">
    @if(count($settings['slider_animation']) > 0)
        <div class="scroll-text">
            <ul class="m-0 p-0 d-flex align-items-center justify-content-center"
                @if(!preg_match('/[^A-Za-z0-9]+/', implode('_',$settings['slider_animation']))) dir="ltr" @endif>
                @foreach($settings['slider_animation'] as $text)
                    <li class="dynamic-color">{{$text}}</li>
                @endforeach
            </ul>
        </div>
    @endif
</section>
