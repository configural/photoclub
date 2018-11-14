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

                <form name="editprofile" method="post">
                <p>
                <label for="name">Аватар (рекомендуется квадратное изображение)</label><br/>
                <input type="text" name="name" value="{{ $user->avatar }}">
                </p>
                    
                <p>
                <label for="name">Имя пользователя</label><br/>
                <input type="text" name="name" value="{{ $user->name }}">
                </p>
                <p>
                <label for="name">Электронная почта (логин)</label><br/>
                <input type="text" name="email" value="{{ $user->email }}">
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
