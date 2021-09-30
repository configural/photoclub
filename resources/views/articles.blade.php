@extends('layouts.app')

@section('title')
Статьи и обзоры
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="jumbotron"><h2>Статьи и обзоры</h2></div>
        @foreach(\App\Article::where('active', 1)->get() as $article)
        <div class='article-preview'>
            <h3>§{{ $article->id}} <a href="{{ url('/articles')}}/{{$article->id}}">{{$article->name}}</a></h3>
            <p>{!! $article->description!!}</p>
        </div>
        @endforeach
    </div>
    
   
</div>
@endsection
