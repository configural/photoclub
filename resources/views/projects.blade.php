@extends('layouts.app')

@section('title')
Фотопроекты
@endsection

@section('content')
<div class="container-fluid">
    <div class="row height50">

        <div class="col-md-8 col-md-offset-2">
            
            <h1>Фотопроекты</h1>
            <p>Фотопроект - это тематическая подборка фотографий разных жанров, объединенных одной общей идеей. 
                Фотопроект может создать любой постоянный участник фотоклуба, в портфолио которого более 20 фотографий. 
                Фотопроект может быть частным и публичным. Пробуем!
            </p>
            
            <p>
            @if (Auth::user())
            @if (Auth::user()->photos()->count() >= 20)
            <a href="{{ route('add_project')}}" class="btn btn-success">Создать свой фотопроект</a>
            @endif
            @endif
            </p>
            @foreach(\App\Project::where('active', 1)->get() as $project)
            @if ($project->photos->count())
            <div class='col-lg-4 col-md-6 col-sm-12'>
                <div class="project_preview">
                    <center>

                            <a href="{{ url('project')}}/{{$project->id}}">

                    <img src="{{ url('photos')}}/{{ $project->photos->first()->user_id }}/_{{ $project->photos->first()->url }}"><br>
                    <h4>{{$project->name}}</h4></a>
                    {{ $project->photos->count() }} фото
                       
                    </center>
                </div>
                
            </div>
            @endif
            @endforeach
            
            <div class="clearfix"></div>
            
            
            
        </div>
    
    
    </div>
</div>
@endsection
