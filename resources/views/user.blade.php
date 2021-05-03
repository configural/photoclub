@extends('layouts.app')

@section('title')
{{$user->name}}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    
                        @if($user->name)
                        {{ $user->name }}
                        @else
                        id{{ $user->id }}
                        @endif
                        
                        <span class="status{{$user->status}}">{{ $user->getStatus->name }}</span>
                    
                        
                </div>
                <div class="panel-body">
                    
                    @if($user->avatar) 
                    <img src="{{ url('/') }}/photos/{{$user->id}}/avatar.jpg" class="avatar">
                        @else 
                        <div class="no_avatar">Нет аватара</div>
                        @endif

                        
                
                        
                
                </div>
                            </div>
            
            
            
            
                
            <div class="panel panel-default">
                <div class="panel-heading">Категории
                </div>

                <div class="panel-body">
                @foreach($cats_list as $cl)
                <p><a href="{{url('/')}}/user/{{$user->id}}/{{$cl->id}}">{{ $cl->name }}</a></p>
                @endforeach
                </div>
            </div>


@if($user->description)    
<div class="panel panel-default">
          <div class="panel-heading">Информация</div>
          <div class="panel-body">
            {!!$user->description!!}
          </div>
    </div>
@endif

                               @if (count($articles))
            
                        <div class="panel panel-default">
                        <div class="panel-heading">Заметки</div>

                        <div class="panel-body">
                            
                            @foreach($articles as $a) 
                            <a href="{{url('/')}}/articles/{{$a->id}}">{{ $a->name }}</a> {!! $a->description!!}
                            @endforeach
                            
                            
                        </div>
                        </div>
                   @endif


                


        </div>
        
        
        <div class="col-lg-8 col-md-6 col-sm-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                @if ($user->id == Auth::user()->id)
                <a href="{{route('addphoto')}}"><i class="fa fa-upload"></i> 
                        Загрузить фото</a>
                @else
                Фотографии
                @endif
                    
                    
                    
                </div>

                <div class="panel-body">



                @foreach($photo as $p)


                   <div class="col-xs-12 col-md-4 col-lg-3 preview-block">
                   
                   <a href="{{ url('/') }}/photo/{{ $p->id }}"><img src="{{ url('/') }}/photos/{{$p->user_id}}/_{{$p->url}}" class="preview">
                       <br/><strong>{{$p->name}}</strong></a>
                   <div class="photoStatus"><i class="fa fa-eye"></i> {{$p->views}}
                       &nbsp;&nbsp;&nbsp;<i class="fa fa-comments-o"></i> {{$p->commentsCount()}}
                       &nbsp;&nbsp;&nbsp;<i class="fa fa-thumbs-up"></i> {{$p->recCount()}}
                       
                   </div>
                   </div>

                @endforeach

                <div class="row">

                </div>
                <center>{{ $photo->links() }}</center>

                </div>
            </div>
            
            

    
            
        </div>
        
       
        <div class="col-lg-2 col-md-3 col-sm-12">
          @if ($user->has_projects())   
            <div class="panel panel-default">
                <div class="panel-heading">Фотопроекты</div>
            <div class="panel-body">
                
                @foreach(\App\Project::where('user_id', $user->id)->get() as $p)
                <p><center><a href="{{ url('project/')}}/{{$p->slug}}">
                        @if ($p->photos->count())
                        <img src="{{ url('photos')}}/{{ $p->photos->first()->user_id }}/_{{ $p->photos->first()->url }}">
                        @else
                        Пустой проект:
                        @endif
                        <br>
                        {{ $p->name }}</a></center></p>
                @endforeach
                
            </div>
            </div>
        @endif 
        
        @include("ads.adsense")
        </div>
        
        
    </div>
</div>
@endsection
