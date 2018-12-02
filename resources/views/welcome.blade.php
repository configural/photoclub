@extends('layouts.app')

@section('title')
Главная страница
@endsection

@section('content')
<div class="container-fluid">
    
    <div class="jumbotron">
        <h3>Добро пожаловать в обновленный Фотоклуб!</h3>
        Новый Фотоклуб наконец-то открылся! Благодарю всех, кто дождался этого события. Теперь у нас новый программный движок, новый адаптивный дизайн и самое главное – теперь все работает быстро и надежно.
        Цель проекта осталась прежней – конструктивное общение на фототемы, обсуждение присланных фотографий. Нам без разницы, какой у вас фотоаппарат и объектив. Если вам есть, что показать – присоединяйтесь, будем рады вас видеть среди участников Фотоклуба!
        
        
        
    </div>
    
</div>

<div class="container-fluid">
    <div class="row">
        
        <div class="col-sm-2">
           


        <div class="panel panel-default">
                <div class="panel-heading">Категории
                </div>

                <div class="panel-body">
                @foreach($cats_list as $cl)
                <p><a href="{{url('/')}}/category/{{$cl->id}}">{{ $cl->name }}</a></p>
                @endforeach
                </div>
            </div>
        
        
        </div>

        
        <div class="col-sm-10">
            <div class="panel panel-default">
                <div class="panel-heading">Фотографии</div>

                <div class="panel-body">

                    @foreach($photos as $photo)


                    <div class="col-sm-3 preview-block">
                        <a href="{{ url('/') }}/photo/{{ $photo->id }}"><img src="{{ url('/') }}/photos/{{ $photo->user_id}}/_{{ $photo->url }}" class="preview"></a>
                    <br/>
                    <a href="{{ url('/') }}/photo/{{ $photo->id }}">
                    <strong>{{ $photo->name }}</strong><br/>
                    @if($photo->user->name)
                        {{$photo->user->name}}
                        
                        @else
                        
                        @endif
                    </a>
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
