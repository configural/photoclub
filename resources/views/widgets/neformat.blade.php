<div>
@foreach ($xml as $entry)
<p>
    @php
        $tmp = explode("T", $entry['updated']);
        $date = explode("-", $tmp[0]);
        $date1 = $date[2].".".$date[1].".".$date[0];
        $time0 = $tmp[1];
        $tmp = explode("+", $time0);
        $time1 = $tmp[0];

    @endphp
    {{ $date1 }} {{ $time1 }}
    
    <strong>{{ $entry['author'] }}</strong> ответил в теме
    <a href="{{$entry['id']}}" target="_blank" rel="">{{ $entry['title'] }}</a>
</p>

@endforeach
</div>