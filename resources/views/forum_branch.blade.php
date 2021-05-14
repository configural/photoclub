@extends('layouts.app')

@section('title')
Правила фотоклуба
@endsection

@section('content')
<div class="container-fluid">
    <div class="row height50">

        <div class="col-md-8 col-md-offset-2">
            
            <h1>{{ $name = \App\Forum::find($id)->name}}</h1>
            <h4>{{ $description = \App\Forum::find($id)->description}}</h4>
            <p>
            @if (Auth::user()->photos()->count() >= 3)
            <a href="{{ route('forum_topic_add') }}" class="btn btn-success">Новая тема</a>
            @else
            <div class="alert alert-warning">
                Создавать новые темы могут только пользователи в портфолио которых есть хотя 3 фотографии.
            </div>
            @endif
            </p>
            <hr>
            @foreach(\App\Topic::select('topics.*')
            ->where('forum_id', $id)
            ->orderBy('updated_at', 'desc')   
            ->get() as $topic)
            
            <p class="pull-right">Последний ответ:
                <br>{{ @\App\Topic::last_post($topic->id) }}</p>
            
            <p><a href="topic/{{ $topic->id}}" class="topic_name">{{ $topic->name }}</a></p>
            <p>{{ @$topic->user->name }}, {{ @\Club::normal_date($topic->updated_at) }}</p>
            
            
            
            
            
            <hr>
            @endforeach
            
 


        </div>
    </div>
</div>
@endsection
