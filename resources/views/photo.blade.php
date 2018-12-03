@extends('layouts.app')

@section('title')
{{$photo->name}}
@endsection


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                
                    <a href="{{ url('/user/'.$photo->user->id.'')}}" class="user-link">
                            
                            @if ($photo->user->name)
                                {{ $photo->user->name }}
                            @else
                                id{{ $photo->user->id }}
                            @endif
                          </a>:
                    
                    {{$photo->category->name}} / {{ $photo->name }}
                    
                    <p class="pull-right"><i class="fa fa-eye"></i> {{$photo->views}}&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-comments-o"></i> {{$comments->count()}}</p>

                
                </div>

                <div class="panel-body photobackground">
                <center>

                   @if($next)
                    <a href="{{url('/')}}/photo/{{ $next->id }}" title="Щелкните для перехода к следующему фото">
                   @endif
                        
                        <img src="{{url('/')}}/photos/{{ $photo->user_id }}/{{$photo->url}}" class="photo" id="photo">
                    @if($next)
                       </a>
                   @endif
                    <div class="photo-nav">
                        @if ($previous) 
                        <a href="{{url('/')}}/photo/{{ $previous->id }}" title="Предыдущее фото" class="btn btn-default"><i class="fa fa-chevron-left"></i> Назад </a> 
                        @endif
                        &nbsp;
                        @if ($next)                        
                        <a href="{{url('/')}}/photo/{{ $next->id }}" title="Следующее фото"  class="btn btn-default"> Вперед <i class="fa fa-chevron-right"></i></a>
                        @endif
                    </div>

                     @if ($photo->description)
                    <div class="photo-description" id="description">{{ $photo->description }}</div>
                    @endif
                    </center>
                    
                    @if (Auth::user()->id == $photo->user_id || Auth::user()->admin)
                    <p><center><a href="{{url('editphoto')}}/{{$photo->id}}" class="btn btn-default"><i class="fa fa-gear"></i> Редактировать описание</a></center></p>
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
                <div class="panel panel-default comment">
                    <div class="panel-heading">
                        <a href="{{ url('/user/'. $comment->user->id .'') }}" class="user-link">
                            @if ($comment->user->name)
                                {{ $comment->user->name }}
                            @else
                                id{{ $comment->user->id }}
                            @endif
                        </a>
                    
                        <span class="pull-right">
                        @if ($comment->created_at) 
                            
                        @endif
                        
                        @if ($comment->updated_at) 
                        <i class="fa fa-calendar"></i> {{ $comment->updated_at }}
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
                
                <a name="comments"></a>
                
                 <div class="panel panel-default">
                     <div class="panel-heading">Добавить комментарий</div>
                     <div class="panel panel-body">
                      
                         
                         
                         @if(Auth::user())
                         <p>Вы вошли как {{ Auth::user()->name }}.</p>

                            <form name="addcomment" action="{{ url('/addcomment')}}" method="post">

                                
                                <p><textarea name="text" class="form-control coment-text"></textarea></p>
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

