<div class="panel panel-default">
    <div class="panel-heading">Обсуждения на форуме</div>
    
<div class="panel-body">
    @foreach(\App\Topic::where('active', 1)->orderBy('updated_at', 'desc')->limit(10)->get() as $topic)
    <p>
        <a href='{{url('forum/topic')}}/{{$topic->id}}'>{{$topic->name}}</a><br>
        <small>{{ $topic->last_post($topic->id) }}</small>
    </p>
    <hr>
    @endforeach
    
</div>



</div>