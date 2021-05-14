@extends('layouts.app')

@section('title')
Правила фотоклуба
@endsection

@section('content')
<div class="container-fluid">
    <div class="row height50">

        <div class="col-md-8 col-md-offset-2">
            
            <form method="post" action="{{route('save_topic')}}">
                <p>
                    Ветка форума: 
                    <select name="forum_id" class="form-control-static">
                    @foreach(\App\Forum::get() as $forum)
                    <option value="{{$forum->id}}">{{ $forum->name }}
                    @endforeach
                </select>
                </p>
                <p>
                <label>Назавание темы</label>

                <input type='text' name='name' value='' required class='form-control'>
                </p>
                <p><textarea class="form-control" name="text" style='height: 400px;'></textarea></p>
                

                {{ csrf_field() }}
            
                <p><button class="btn btn-success">Отправить</button></p>
            
            </form>

        </div>
    </div>
</div>



@endsection
