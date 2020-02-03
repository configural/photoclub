@extends('layouts.app')

@section('title')
Правила фотоклуба
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        
        <div class="col-md-3">
            
        <div class="panel panel-default">
            <div class="panel-heading">Об авторе проекта
                </div>

                <div class="panel-body">
                    <p><img src="{{ url('/')}}/photos/3/avatar.jpg" class="avatar"></p>
                    <p>Меня зовут Артем Кашканов. Я хотел стать фотографом, но что-то пошло не так и я стал программистом. Тем не менее, мое основное хобби - фотография :)</p>
                    <p>Именно это сочетание навыков породило <a href="http://www.artem-kashkanov.ru" target="_blank">Фотосайт Артема Кашканова</a> и данный Фотоклуб. </p>
                    <p>На правах разработчика, администратора, владельца проекта, а также бывшего преподавателя фотографии хочу предложить вашему вниманию мои <a href="http://artem-kashkanov.ru/pdf-books.html" target="_blank">электронные книги</a>.</p>

            </div>
        </div>
            
        </div>
        
        <div class="col-md-8">
            
            <h1>Контакты</h1>
            <p class="lead">
            <ol>
                <li><a href="http://www.artem-kashkanov.ru">Фотосайт Артема Кашканова</a></li>
                
                <li>Email: kashkanov_as@mail.ru</li>
                
                <li>Телефон: +792O2525268</li>
                
                <li><a href="https://vk.com/a.kashkanov" target="_blank">Я Вконтакте</a>                  
                <li><a href="https://www.instagram.com/artemkashkanov/" target="_blank">Мой Instagram</a></li>
                    
            </ol>
            
        </p>
        <p><a href="{{url('/')}}/donate">Поддержать проект</a>
        </div>
    </div>
</div>
@endsection
