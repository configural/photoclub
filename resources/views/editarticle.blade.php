@extends('layouts.app')

@section('title')
редактирование описания фотографии
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Редактирование статьи</h1></div>

                <div class="panel-body">
                
                <form name="editcomment" method="post" action="">
                    <p><label>Название статьи: </label>
                        <input name="name" class="form-control" type="text" value="{{$article->name}}"></p>
                    

                    
                    <p><label>Текст статьи:</label>
                        <textarea name="text" class="form-control" placeholder="" style="height: 600px;">{{$article->text}}</textarea>
                    </p>
                    
                    <p><label>Анонс статьи:</label>
                        <textarea name="description" class="form-control" placeholder="">{{$article->description}}</textarea>
                    </p>                    
                    <p><label>Опубликовано (1/0):</label>
                    <input name="active" type="text" value="{{$article->active}}">
                {{ csrf_field() }}

                <p><button class="btn btn-success">Обновить статью</button></p>
                </form>
                
                <hr>
                <h3>Удаление статьи</h3>
                Для удаления статьи нажмите пометьте галочку и нажмите кнопку "Удалить". Все комментарии к фотографии также будут удалены. <br><br>
                <form name="delete" action="{{ url('/deletearticle')}}" method="post">
                    
                    <input type="hidden" name="id" value="{{$article->id}}">
                    <p><input type="checkbox" required> Я действительно хочу удалить статью</p>
                    <p><button class="btn btn-danger">Удалить стаьтью</button></p>
                                    {{ csrf_field() }}

                    
                </form>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
