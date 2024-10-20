<div class="slogan">
    <ul class="m-0 p-0">
        @foreach($slogans as $slogan)
        <li class="list-unstyled d-flex align-items-center font-re small">
            <img src="{{$slogan->image}}" width="30" alt=" {{$slogan['value']}}" title=" {{$slogan['value']}}" loading="lazy" class="me-2">
            {{$slogan['value']}}
        </li>
        @endforeach
    </ul>
</div>
