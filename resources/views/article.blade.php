@extends('layouts.app')

@section('title')
{{ $article->name }}
@endsection

@section('content')
<div class="container">
    <div class="row">
    @if(Auth::user() and Auth::user()->status == 4)
    <div class="alert alert-success">Вы зашли с правами модератора. [<a href="{{ url('/') }}/articles/{{$article->id}}/edit">Редактировать статью</a>]</div>
    
    @endif
    
    <div class="jumbotron">
        <center><h1>{{ $article->name }}</h1>
            <p>{!! $article->description !!}</p></center> 
    </div>
    
        <div class="col">

       {!! $article->text !!}
        </div>
    </div>
    
   
</div>
@endsection
