@extends('layouts.app')

@section('title')
Правила фотоклуба
@endsection

@section('content')
<div class="container-fluid">
    <div class="row height50">

        <div class="col-md-8 col-md-offset-2">
            
            @php
            $post = \App\Post::where('id', $id)->where('user_id', Auth::user()->id)->first();
            @endphp
            <form method="post" action="{{route('save_post')}}">
                <input type="hidden" name="id" value="{{$id}}">
                <p><textarea class="form-control" name="text">{{ $post->text }}</textarea></p>
                <p><button class="btn btn-success">Отправить</button></p>
                {{ csrf_field() }}
            </form>

        </div>
    </div>
</div>



@endsection
