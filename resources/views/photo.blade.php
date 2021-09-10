@extends('layouts.app')

@section('title')
{{ $photo->user->name }} – {{$photo->name}}
@endsection


@section('content')


<div class="container-fluid">
    <div class="row">
        
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
                    
                                         <p class="pull-right"> <i class="fa fa-calendar"></i> {{ @str_limit($published_at, 10, '') }} </p>  

                
                </div>

                <div class="panel-body photobackground">
                <center>


                    
                        
                        <img src="{{url('/')}}/photos/{{ $photo->user_id }}/{{$photo->url}}" 
                             alt="Фотография - {{ $photo->name}}, автор - {{ $photo->user->name }}" 
                             class="photo" id="photo" title="кликните чтобы увеличить/уменьшить">

                    
                
                </center>
<div class="container">
<div class="row">
    <div class="col-md-3">
            @include('layouts.kot')
                @if (Auth::user() and Auth::user()->status == 4)
                <ul>
                @foreach($photo->recomendations as $rec)
                <li>{{$rec->user->name}} –  
                   
                    <span class="bukv">
                     @if ($rec->k) К @endif
                      @if ($rec->o) О @endif
                       @if ($rec->t) Т @endif
                    </span>
                </li>
                @endforeach
                </ul>
                @endif
                <p> Просмотры: {{$photo->views}}&nbsp;&nbsp;&nbsp;&nbsp; Комментарии: {{$comments->count()}}</p>
 
    </div>
    
    <div class="col-md-6">
        <center>
    
                    <div class="photo-nav">
                        <p>@if ($previous) 
                        <a href="{{url('/')}}/photo/{{ $previous->id }}" title="Предыдущее фото" class="btn btn-default"><i class="fa fa-chevron-left"></i> Назад </a> 
                        @endif

                        @if ($next)                        
                        <a href="{{url('/')}}/photo/{{ $next->id }}" title="Следующее фото"  class="btn btn-default"> Вперед <i class="fa fa-chevron-right"></i></a>
                        </p>
                        @endif
                    @if ($photo->fullsize)
                    <p><a href="{{$photo->fullsize}}" target="_blank" rel="nofollow" class="btn btn-primary"><i class="fa fa-arrows"></i> Полный размер</a></p>
                    @endif
                    
                    </div>
                    
                    <div class="photo-description" id="description">            
                    @if ($photo->description)
                    {!! $photo->description !!}
                    @endif
                    
                    @if ($photo->projects->count())
                    Фото участвует в проектах: 
                    
                     @foreach($photo->projects as $p)
                     <p> <i class="fa fa-camera red"></i> <a href="{{ url('/project')}}/{{$p->id}}">{{$p->name}}</a></p>
                    @endforeach
                    
                    @endif
                    </div>

                    <small>
                     @if($photo->Model)   
                        Камера: {{ $photo->Model }}<br/> 
                     @endif

                     @if($photo->ExposureProgram)     
                        Режим {{$photo->ExposureProgram}}, 
                     @endif
                     
                     @if($photo->FocalLength)     
                       фокусное расстояние: {{$photo->FocalLength}} мм, 
                     @endif
                     
                     @if($photo->ExposureTime)
                        выдержка: {{$photo->ExposureTime}} сек, 
                     @endif
                     
                     @if($photo->FNumber)
                        диафрагма: {{$photo->FNumber}}, 
                     @endif
                     
                     @if($photo->ISOSpeedRatings)
                        ISO{{$photo->ISOSpeedRatings}},
                     @endif
                     
                     @if($photo->ExposureBiasValue)
                        экспокоррекция: {{$photo->ExposureBiasValue}}EV, 
                     @endif
                        
                     @if($photo->Software)
                        <br/> ПО: {{$photo->Software}} 
                     @endif
                    </small>
                    @if(Auth::user())
                    @if (Auth::user()->id == $photo->user_id || Auth::user()->admin)
                    <p><center><a href="{{url('editphoto')}}/{{$photo->id}}" class="btn btn-default"><i class="fa fa-gear"></i> Редактировать описание</a></center></p>
                    @endif
                    @endif
        </center>
    </div>                    
    <div class="col-md-3 photo-description">
        
        @if ($photo->critic_level <> 1)
        <div class="critic-{{$photo->critic_level}}">
        <p>{{ $critic_levels[$photo->critic_level] }}</p>
        </div>
        @endif
        
    </div>               
                        
    </div>



</div></div></div>
                    


        
    
    <!-- Комментарии -->
    <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-md-offset-2">
                
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
                        
                     <div class="reply-button"><span onClick="javascript:reply('{{$comment->user->id}}', '{{ $comment->user->name }}');" class = "reply-button">[ответить]</span></div>
                     
                        <span class="pull-right">
                        @if ($comment->updated_at) 
                        <i class="fa fa-calendar"></i> {{ date("d.m.Y", strtotime($comment->updated_at)) }}
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
                
                 <div class="panel  panel-primary">
                     <div class="panel-heading">Добавить комментарий</div>
                     <div class="panel panel-body">
                      
                         
                         
                         @if(Auth::user())
                         <p>Вы вошли как {{ Auth::user()->name }}.</p>
                         <p>

                         </p>

                            <form name="addcomment" action="{{ url('/addcomment')}}" method="post">
                                <p><textarea name="text" class="form-control coment-text" id="txtComment"></textarea></p>
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="photo_id" value="{{ $photo->id }}">


                                {{ csrf_field() }}

                                <p><button class="btn btn-success">Отправить комментарий</button></p>
                            </form>

                            @else 
                            Для комментирования нужно <a href="{{ url('/')}}/register">зарегистрироваться</a> или <a href="{{ url('/')}}/login">залогиниться</a>

                            @endif
                         
                         
                     </div>
                     
                 </div>

                
                
                </div>
                
                
                
                <div class="col-md-2">

                @include("ads.adsense")
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

<script>
function optimize() {
    $("#photo").css({"maxHeight": $(window).height()*0.85});    

}
</script>

@if ($photo->optimize_size)
<script>
optimize()
</script>

@endif

<script>
var small = 1;
$("#photo").click(function(){
    if (small == 1) {
        $("#photo").css({"maxHeight": 1200});
        small = 0;
    }
    else
    {optimize();
    small = 1;
        }
    
    
});
</script>

@endsection

