@extends('layouts.app')

@section('title')
Фотопроект - {{ $project->name }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row height50">

        <div class="col-md-8 col-md-offset-2">
            
            <h1>{{ $project->name }}</h1>
            <p>
                {{ $project->description}}
            </p>
            
            
            @foreach($photos as $photo)
            <h4><a href="{{url('/user')}}/{{$photo->user_id}}">{{ $photo->user->name }}</a>: {{ $photo->name}}</h4>
            <img src="{{url('/')}}/photos/{{ $photo->user_id }}/{{$photo->url}}" 
                             alt="Фотография - {{ $photo->name}}, автор - {{ $photo->user->name }}" 
                             class="photo" id="" title="">
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
