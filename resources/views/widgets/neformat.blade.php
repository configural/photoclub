@foreach ($xml as $entry)
<p>
    {{ $entry['updated'] }} 
    <strong>{{ $entry['author'] }}</strong> ответил в теме
    <a href="{{$entry['id']}}">{{ $entry['title'] }}</a>
</p>

@endforeach