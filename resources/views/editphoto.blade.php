@extends('layouts.app')

@section('title')
редактирование описания фотографии
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Редактирование описания фотографии</h1></div>

                <div class="panel-body">
                <img src="{{url('/')}}/photos/{{$photo->user_id}}/{{$photo->url}}"/>
                <form name="editcomment" method="post" action="{{ url('/storephoto')}}">
                    <p><label>Название фотографии: </label>
                        <input name="name" class="form-control" type="text" value="{{$photo->name}}"></p>
                    
                    
                    <p><label>Категория: </label>
                        
                       <select name="category_id" class="form-control">
                        @foreach($categories as $cat)
                            @if ($cat->id == $photo->category_id)
                            <option value="{{$cat->id}}" selected>{{$cat->name}}</option>
                            @else
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endif
                        @endforeach
                        </select>
                    </p>
                                           
                    
                    
                    <p><label>Описание фотографии:</label>
                        <textarea name="description" class="form-control" placeholder="История, связанная с фотографией, условия съемки, настройки, использованная техника - все что угодно.">{{$photo->description}}</textarea>
                    </p>
                    
                
                    <input name="id" type="hidden" value="{{$photo->id}}">
                {{ csrf_field() }}

                <p><button class="btn btn-success">Обновить информацию</button></p>
                </form>
                
                <hr>
                <h3>Удаление фотографии</h3>
                Для удаления фотографии нажмите пометьте галочку и нажмите кнопку "Удалить". Все комментарии к фотографии также будут удалены. <br><br>
                <form name="delete" action="{{ url('/deletephoto')}}" method="post">
                    
                    <input type="hidden" name="id" value="{{$photo->id}}">
                    <p><input type="checkbox" required> Я действительно хочу удалить фотографию</p>
                    <p><button class="btn btn-danger">Удалить фотографию</button></p>
                                    {{ csrf_field() }}

                    
                </form>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
