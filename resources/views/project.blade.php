@extends('layouts.app')

@section('title')
Фотопроект - {{ $project->name }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row height50">

        <div class="col-md-8 col-md-offset-2">
            
            <h1>{{ $project->name }}</h1>
            <i><p>Администратор проекта: <a href="{{url('/user')}}/{{ $project->user->id}}">{{ $project->user->name}}</a>.
            @if ($project->is_private) 
            Это частный проект. В нем только авторские фотографии.
            @else
            Это публичный проект. В него могут присылать фотографии все зарегистрированные пользователи.
            @endif
                </p></i>
            
            <p>
                {!! $project->description!!}
            </p>
            
            @if (Auth::user() and Auth::user()->id == $project->user_id)
            <a href="{{ url('/project/edit') }}/{{$project->id}}" class="btn btn-success">Редактировать</a>
            @endif
            
            <p>
                <script src="https://yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-curtain data-size="l" data-shape="round" data-services="messenger,vkontakte,facebook,odnoklassniki,telegram"></div>
            </p>
            
            @foreach($photos as $photo)
            <h4><a href="{{url('/user')}}/{{$photo->user_id}}">{{ $photo->user->name }}</a>: {{ $photo->name}}</h4>
            <div class="project_photo">
            
            <img src="{{url('/')}}/photos/{{ $photo->user_id }}/{{$photo->url}}" 
                             alt="Фотография - {{ $photo->name}}, автор - {{ $photo->user->name }}" 
                             class="photo" id="" title="">
            </div>
            <p>{!! $photo->description !!}</p>
            <hr/>
            @endforeach
            <p>
                {{ $photos->links() }}
            </p>
              




        </div>
    </div>
</div>
@endsection
