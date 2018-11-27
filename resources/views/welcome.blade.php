@extends('layouts.app')

@section('title')
Главная страница
@endsection

@section('content')
<div class="container-fluid">
    
    <div class="jumbotron">
        <h3>Добро пожаловать в обновленный Фотоклуб!</h3>
        Новый Фотоклуб наконец-то открылся! Благодарю всех, кто дождался этого события. Теперь у нас новый программный движок, новый адаптивный дизайн и самое главное - теперь все работает быстро, надежно и безопасно!
        Цель проекта осталась прежней – конструктивное общение на фототемы, обсуждение прислнных фотографий. 
        
        
        
    </div>
    
</div>

<div class="container-fluid">
    <div class="row">
        
        <div class="col-sm-3">
           


        <div class="panel panel-default">
                <div class="panel-heading">Категории
                </div>

                <div class="panel-body">
                @foreach($cats_list as $cl)
                <p><a href="{{url('/')}}/category/{{$cl->id}}">{{ $cl->name }}</a></p>
                @endforeach
                </div>
            </div>
        
        
        <div class="panel panel-default">
            <div class="panel-heading">Об авторе проекта
                </div>

                <div class="panel-body">
                    <p><img src="http://www.artem-kashkanov.ru/books/images/me.jpg" class="avatar"></p>
                    <p>Меня зовут Артем Кашканов. Я живу и работаю в Нижнем Новгороде в сфере информационных технологий. Моя основная работа – веб-программирование, основное хобби - фотография. 
                        Именно это сочетание навыков породило <a href="http://www.artem-kashkanov.ru" target="_blank">Фотосайт Артема Кашканова</a> и данный Фотоклуб. </p>
                    <p>На правах разработчика, администратора, владельца проекта, а также бывшего преподавателя фотографии хочу предложить вашему вниманию мои <a href="http://artem-kashkanov.ru/pdf-books.html" target="_blank">электронные книги</a>.</p>

            </div>
        </div>
        
        </div>

        
        <div class="col-sm-9">
            <div class="panel panel-default">
                <div class="panel-heading">Фотографии</div>

                <div class="panel-body">

                    @foreach($photos as $photo)


                    <div class="col-sm-3 preview-block">
                    {{ $photo->name }}<br/>
                    <a href="{{ url('/') }}/photo/{{ $photo->id }}"><img src="{{ url('/') }}/photos/{{ $photo->user_id}}/_{{ $photo->url }}" class="preview"></a>
                    <div class="photoStatus"><i class="fa fa-eye"></i> {{ $photo->views }}
                    &nbsp;&nbsp;&nbsp;<i class="fa fa-comments-o"></i> {{ $photo->commentsCount() }}
                    </div>
                    </div>

                    @endforeach



                </div>

               <center>{{ $photos->links() }}</center>
            </div>
    </div>
        </div>
    </div>
</div>
@endsection
