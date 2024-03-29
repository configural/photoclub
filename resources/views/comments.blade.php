@php ( $i = 0 )
@extends('layouts.app')
@section('title')
Комментарии к фотографиям
@endsection


@section('content')
<div class="container-fluid">
                        
    <h1>Комментарии к фотографиям</h1>
    
            
                
                @foreach($comments as $comment)
                <div class="row">

                <div class="col-md-9">    
                <a name="{{ $comment->id }}"></a>
                <div class="panel panel-default comment">
                    <div class="panel-heading">
                @if ($comment->photo->user->name)
                            <a href="{{ url('/')}}/user/{{$comment->photo->user_id}}">{{$comment->photo->user->name}}</a>
                            @else
                            <a href="{{ url('/')}}/user/{{$comment->photo->user_id}}">id{{$comment->photo->user_id}}</a>
                            @endif
                             / {{ $comment->photo->name }}
                    

                    
                    </div>
                    <div class="panel panel-body" id="">
                        <div class="row">
                            <div class="col-md-2">
                        <a href="{{url('/')}}/photo/{{$comment->photo_id}}"><img src="{{ url('/')}}/photos/{{$comment->photo->user_id}}/_{{$comment->photo->url}}" class="preview"></a>
                    
                            </div>
                            <div class="col-md-10">
                            <a href="{{ url('/user/'. $comment->user->id .'') }}">
                            @if ($comment->user->name)
                                {{ $comment->user->name }}
                            @else
                                id{{ $comment->user->id }}
                            @endif
                        </a>
                    
                        <span class="pull-right">

                        @if ($comment->updated_at) 
                        <i class="fa fa-calendar"></i> {{ $comment->updated_at }}
                        @endif
                        </span>
                    <hr/>
                        {!! $comment->bbCode($comment->text) !!}</div>
                    


                    
                    @if (Auth::user())
                    
                        @if (Auth::user()->id == $comment->user_id  || Auth::user()->admin)
                        <!--
                            [<a href="{{ url('/editcomment')}}/{{ $comment->id }}">Редактировать</a>] 
                            [<a href="{{ url('/deletecomment')}}/{{ $comment->id }}" onclick="return confirm('Действительно удалить?');">Удалить</a>]
                        -->
                        </center>
                        @endif
                    
                    @endif 
                    </div>
                    </div>
                </div>
                </div>
                    
                    <div class="col-md-3">
                        
                        @if($i%5 == 0 && $i<15)
                        
                        @endif
                        <?php $i++; ?>
                        
                    </div>
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
