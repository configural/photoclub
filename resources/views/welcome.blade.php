@extends('layouts.app')

@section('title')
только красивые фотографии!
@endsection

@section('content')
<div class="container-fluid">
    
    <div class="jumbotron">
        <h3>Добро пожаловать в Фотоклуб!</h3>
        Цель проекта – конструктивное общение на фототемы, обсуждение присланных фотографий. Нам без разницы, какой у вас фотоаппарат и объектив. Если вам есть, что показать – присоединяйтесь, будем рады вас видеть среди участников Фотоклуба!
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
            
            <div class="panel panel-default">
                <div class="panel-heading">Ссылки
                </div>

                <div class="panel-body">
                <p><a href="http://www.artem-kashkanov.ru"  target="_blank">Фотосайт Артема Кашканова</a></p>
                <p><a href="http://www.neformat.info" target="_blank" rel="nofollow">Фотофорум Неформат</a></p>

                </div>
            </div>
       
                @include("ads.adsense")
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
