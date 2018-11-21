@extends('layouts.app')

@section('title')
Комментарии к фотографиям
@endsection


@section('content')
<div class="container-fluid">

    <!-- Комментарии -->
    
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                
                @foreach($comments as $comment)
                <a name="{{ $comment->id }}"></a>
                <div class="panel panel-default comment">
                    <div class="panel-heading">
                        <a href="{{ url('/user/'. $comment->user->id .'') }}">
                            @if ($comment->user->name)
                                {{ $comment->user->name }}
                            @else
                                id{{ $comment->user->id }}
                            @endif
                        </a>
                    
                        <span class="pull-right">
                        @if ($comment->created_at) 
                            Написано: {{ $comment->created_at }}
                        @endif
                        
                        @if ($comment->updated_at) 
                          / обновлено: {{ $comment->updated_at }}
                        @endif
                        </span>
                    
                    </div>
                    <div class="panel panel-body" id="">{!! $comment->bbCode($comment->text) !!}</div>
                    


                    
                    @if (Auth::user())
                    
                    @if (Auth::user()->id == $comment->user_id  || Auth::user()->admin)
                    <center>
                        [<a href="{{ url('/editcomment')}}/{{ $comment->id }}">Редактировать</a>] 
                        [<a href="{{ url('/deletecomment')}}/{{ $comment->id }}" onclick="return confirm('Действительно удалить?');">Удалить</a>]
                    </center>
                    @endif
                    
                    @endif 
                    
                </div>
                @endforeach
                
                <center>
                {{ $comments->links() }}
                </center>


                
                
                </div>
            </div>
            
           
        
    </div>
</div>


@endsection
