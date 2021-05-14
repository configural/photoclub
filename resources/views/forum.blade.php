@extends('layouts.app')

@section('title')
Фотофорум
@endsection

@section('content')
<div class="container-fluid">
    <div class="row height50">

        <div class="col-md-8 col-md-offset-2">
            
            <h1>Форум</h1>
            
            @foreach(\App\Forum::where('active', 1)->get() as $forum)
            <h3><a href="{{ route('forum')}}/{{ $forum->id}}">{{ $forum->name }}</a></h3>
            @endforeach
            
 


        </div>
    </div>
</div>
@endsection
