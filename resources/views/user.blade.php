@extends('layouts.app')

@section('title')
{{$user->name}}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    
                        @if($user->name)
                        {{ $user->name }}
                        @else
                        id{{ $user->id }}
                        @endif
                    
                        
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

        </div>
        
        
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                Фотографии
                </div>

                <div class="panel-body">



                @foreach($photo as $p)


                   <div class="col-md-3 preview-block">
                   {{$p->name}}<br/>
                   <a href="{{ url('/') }}/photo/{{ $p->id }}"><img src="{{ url('/') }}/photos/{{$p->user_id}}/_{{$p->url}}" class="preview"></a>
                   <div class="photoStatus"><i class="fa fa-eye"></i> {{$p->views}}
                       &nbsp;&nbsp;&nbsp;<i class="fa fa-comments-o"></i> {{$p->commentsCount()}}
                       
                   </div>
                   </div>

                @endforeach

                <div class="row">

                </div>
                <center>{{ $photo->links() }}</center>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
