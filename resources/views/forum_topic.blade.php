@extends('layouts.app')

@section('title')
{{$topic->name}}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row height50">

        <div class="col-md-8 col-md-offset-2">
            <a href="{{ url('forum')}}">Форум</a> / 
            <a href="{{ url('forum')}}/{{$topic->forum_id}}">{{ $topic->forum->name }}</a>
            
            <h1>{{ $topic->name }}</h1>

            <div class="panel panel-info">
                <div class="panel-heading comment">
                    <a href="{{ url('/user/')}}/{{$topic->user_id}}">{{ @$topic->user->name }}</a>
                    <div class="reply-button">
                    <span onClick="javascript:reply('{{$topic->user->id}}', '{{ $topic->user->name }}');" class = "reply-button">[ответить]</span></div>
                
                    
                    @if (Auth::user() and Auth::user()->id == $topic->user_id)
                    <a href="{{ url('/')}}/edit_topic/{{$topic->id}}"class="btn-xs btn-default pull-right">Редактировать тему</a> 
                    <p class="pull-right">{{ \Club::normal_date($topic->updated_at)}}</p>
                    
                    @endif
                    
                    
                </div>
                <div class="panel-body">
                {!! $topic->text !!}
                </div>
                </div>
            
            @foreach($posts as $post)
            <a name="{{ $post->id }}"></a>
            <div class="panel panel-default">
                <div class="panel-heading comment">
                <a href="{{ url('/user/')}}/{{$post->user_id}}">{{ $post->user->name }}</a>
                <div class="reply-button">
                    <span onClick="javascript:reply('{{$post->user->id}}', '{{ $post->user->name }}');" class = "reply-button">[ответить]</span></div>
                    
                    @if (Auth::user() and Auth::user()->id == $post->user_id and $topic->active)
                     <a href="{{ url('/')}}/edit_post/{{$post->id}}"class="btn-xs btn-default pull-right">Редактировать</a>
                     
                    @endif
                    <p class="pull-right">{{ \Club::normal_date($post->updated_at)}}</p> 
                </div>
                <div class="panel-body">
                    {!! $post->text!!}
                    
                </div>
            </div>
            
            
            @endforeach
            <p>{{ $posts->links()}}</p>

            @if ($topic->active)
            <form method="post" action="{{route('add_post')}}">
                <input type="hidden" name="topic_id" value="{{$topic->id}}">
                <p><textarea class="form-control" name="text"></textarea></p>
                <p><button class="btn btn-success">Отправить</button></p>
                {{ csrf_field() }}
            </form>
            @else
            <div class='alert alert-info'>Тема закрыта</div>
            @endif

        </div>
    </div>
</div>


<script>
    function reply(id, name) {
        
        old_html=tinyMCE.activeEditor.getContent({format: ''});
        
        
        tinyMCE.activeEditor.setContent( old_html + name + ":&nbsp; ");
        
        tinyMCE.activeEditor.focus();
    }

</script>

@endsection
