<script>
    (function() {
        @foreach($timer_products as $timer)
        const second{{$timer['id']}} = 1000,
            minute{{$timer['id']}} = second{{$timer['id']}} * 60,
            hour{{$timer['id']}} = minute{{$timer['id']}} * 60,
            day{{$timer['id']}} = hour{{$timer['id']}} * 24;

        let countDown{{$timer['id']}} = new Date("{{$timer['end_timer']}}").getTime(),
            x{{$timer['id']}} = setInterval(function() {

                    let now{{$timer['id']}} = new Date().getTime(),
                distance{{$timer['id']}} = countDown{{$timer['id']}} - now{{$timer['id']}};

                document.getElementById("days{{$timer['id']}}").innerText = Math.floor(distance{{$timer['id']}} / (day{{$timer['id']}}));
                document.getElementById("hours{{$timer['id']}}").innerText = Math.floor((distance{{$timer['id']}} % (day{{$timer['id']}})) / (hour{{$timer['id']}}));
                document.getElementById("minutes{{$timer['id']}}").innerText = Math.floor((distance{{$timer['id']}} % (hour{{$timer['id']}})) / (minute{{$timer['id']}}));
                document.getElementById("seconds{{$timer['id']}}").innerText = Math.floor((distance{{$timer['id']}} % (minute{{$timer['id']}})) / second{{$timer['id']}});

            }, 0)
        @endforeach
    }());
</script>
