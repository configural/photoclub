@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Мой профиль</div>

                <div class="panel-body">
                    
                    
                    @if($me->name)
                    <p>{{ $me->name }}, вы успешно вошли в систему!</p>
                    @else
                    <p>Вы успешно вошли в систему! Пожалуйста, укажите свое имя в настройках профиля!</p>
                    @endif
                    
                    
                    <p><a href="{{url('/editprofile')}}" class="btn btn-secondary">Редактировать профиль</a></p>


                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{url('/addphoto')}}" class="btn btn-primary">Загрузить фотографию</a>
                </div>

                <div class="panel-body">
                    
                    
                    @foreach($photos as $photo)

                   <div class="row">
                        <div class="col-md-2 preview-block">
                                           <a href="{{url('/')}}/photo/{{ $photo->id }}"><img src="{{url('/')}}/photos/{{$photo->user_id}}/{{$photo->url}}" class="preview"></a>
                        </div>

                        <div class="col-md-10">
                                <h4>{{$photo->name}}</h4>
                                <p>Рекомендации: 10 | 2 | 8</p>
                                <p>Просмотров: {{$photo->views}}</p>
                                <p>Комментариев: </p>
                           
                        </div>
                    </div> <!-- row -->
                    
                    @endforeach

                </div>
            </div>





        </div>
    </div>
</div>
@endsection
