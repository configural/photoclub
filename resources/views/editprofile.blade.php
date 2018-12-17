@extends('layouts.app')

@section('title')
редактирование профиля
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Редактирование профиля</h1></div>

                <div class="panel-body">

                <form name="editprofile" method="post"  enctype="multipart/form-data">
                <label for="avatar">Ваше фото, аватар (рекомендуется изображение разрешением не менее 400 пикселей по длинной стороне в формате jpeg)</label><br/>
                <input type="file" name="avatar">
                    <p>
                    @if ($user->avatar) 
                <p>Текущий аватар:</p>
                <p><img src="{{ url('/') }}/photos/{{ $user->id }}/avatar.jpg"></p>
                    @endif
                
                </p>
                    
                <p>
                <label for="name">Имя пользователя</label><br/>
                <input type="text" name="name" value="{{ $user->name }}">
                </p>
                <p>
                <label for="name">Электронная почта (логин)</label><br/>
                <input type="text" name="email" value="{{ $user->email }}">
                </p>
                
                <p>
                <label for="description">Коротко о себе</label><br/>
                <textarea name="description" class="form-control">{{ $user->description }}</textarea>
                </p>
                
                <p><button>Обновить информацию</button></p>

                {{ csrf_field() }}

                </form>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
