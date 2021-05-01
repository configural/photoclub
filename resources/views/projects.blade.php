@extends('layouts.app')

@section('title')
Фотопроекты
@endsection

@section('content')
<div class="container-fluid">
    <div class="row height50">

        <div class="col-md-8 col-md-offset-2">
            
            <h1>Фотопроекты</h1>
            
            @foreach(\App\Project::where('active', 1)->get() as $project)
            <div class='col-lg-4 col-md-6 col-sm-12'>
                <div class="project_preview">
                    <center>
                        <a href="{{ url('project')}}/{{$project->slug}}">
                    <img src="{{ url('photos')}}/{{ $project->photos->first()->user_id }}/_{{ $project->photos->first()->url }}"><br>
                    <h4>{{$project->name}}</h4>
                        <strong>{{$project->user->name}}</strong></a>
                    </center>
                </div>
                
            </div>
            @endforeach
            
            
              




        </div>
    </div>
</div>
@endsection
