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

                                      
                   <div class="col-md-3 preview-block">
                   {{$photo->name}}<br/>
                    <a href="/public/photo/{{ $photo->id }}"><img src="/public/photos/{{$photo->user_id}}/{{$photo->url}}" class="preview"></a>
                   <br/>
                   Просмотров: {{$photo->views}}
                   </div>
                    
                    
                    @endforeach

                </div>
            </div>





        </div>
    </div>
</div>
@endsection
