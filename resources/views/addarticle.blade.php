@extends('layouts.app')

@section('title')
Добавить статью
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Создание статьи</h1></div>

                <div class="panel-body">
                
                <form name="editcomment" method="post" action="">
                    <p><label>Название статьи: </label>
                        <input name="name" class="form-control" type="text" value="" required></p>
                    
                    <p><label>Текст статьи:</label>
                        <textarea name="text" class="form-control" placeholder="" style="height: 600px"></textarea>
                    </p>

                    <p><label>Анонс статьи:</label>
                        <textarea name="description" class="form-control" placeholder=""></textarea>
                    </p>
                    
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                    
                    <p><label>Опубликовано (1/0):</label>
                    <input name="active" type="text" value="0">
                {{ csrf_field() }}

                <p><button class="btn btn-success">Обновить статью</button></p>
                </form>
                




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
