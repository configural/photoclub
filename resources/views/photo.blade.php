@extends('layouts.app')

@section('title')
{{$photo->name}}
@endsection


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{$photo->category->name}} / {{ $photo->name }}
                
                    <span class="pull-right">Автор: <a href="{{ url('/user/'.$photo->user->id.'')}}">
                            
                            @if ($photo->user->name)
                                {{ $photo->user->name }}
                            @else
                                id{{ $photo->user->id }}
                            @endif
                          </a></span>
                
                
                </div>

                <div class="panel-body">
                <center>



                        <img src="{{url('/')}}/photos/{{ $photo->user_id }}/{{$photo->url}}" class="photo">

                </center>
                    <hr>
                    <p class="pull-right">Просмотров: {{$photo->views}}</p>
                    <p>{{ $photo->description }}</p>
                    
                    @if (Auth::user()->id == $photo->user_id)
                    <p><center><a href="{{url('editphoto')}}/{{$photo->id}}" class="btn btn-default">Редактировать описание фото</a></center></p>
                    @endif
                    
                   </div>



                </div>
             </div>
        </div>
    <!-- Комментарии -->
    
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                
                @foreach($comments as $comment)
                <a name="{{ $comment->id }}"></a>
                <div class="panel panel-default">
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
                    
                    @if (Auth::user()->id == $comment->user_id)
                    <center>
                        [<a href="{{ url('/editcomment')}}/{{ $comment->id }}">Редактировать</a>] 
                        [<a href="{{ url('/deletecomment')}}/{{ $comment->id }}">Удалить</a>]
                    </center>
                    @endif
                    
                    @endif 
                    
                </div>
                @endforeach
                
                <a name="comments"></a>
                
                 <div class="panel panel-default">
                     <div class="panel-heading">Добавить комментарий</div>
                     <div class="panel panel-body">
                      
                         
                         
                         @if(Auth::user())
                         <p>Вы вошли как {{ Auth::user()->name }}.</p>

                            <form name="addcomment" action="{{ url('/addcomment')}}" method="post">

                                
                                <p><textarea name="text" class="form-control"></textarea></p>
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="photo_id" value="{{ $photo->id }}">


                                {{ csrf_field() }}

                                <p><button class="btn btn-success">Отправить комментарий</button></p>
                            </form>

                            @else 
                            Для комментирования нужно зарегистрироваться или залогиниться

                            @endif
                         
                         
                     </div>
                 </div>

                
                
                </div>
            </div>
            
           
        
    </div>
</div>


@endsection
