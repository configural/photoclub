@extends('layouts.app')

@section('title')
Моя страница
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @include('layouts.usermenu')
            </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Мои фотографии</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-4"><a href="{{url('/addphoto')}}" class="btn btn-lg btn-primary">Загрузить фотографию</a></div>
                        <div class="col-sm-8">Вы можете загружать 1 фото в день.
                        
                        </div>
                        
                    </div>
                    <hr>
                    
                    @foreach($photos as $photo)

                   <div class="row">
                        <div class="col-md-2">
                                           <a href="{{url('/')}}/photo/{{ $photo->id }}"><img src="{{url('/')}}/photos/{{$photo->user_id}}/_{{$photo->url}}" class="preview"></a>
                        </div>

                        <div class="col-md-5">
                                <h4>{{$photo->name}}</h4>
                                
                                <p>Просмотров: {{$photo->views}}</p>
                                <p>Комментариев: {{$photo->commentsCount()}}</p>
                                
                                <p><a href="{{url('editphoto')}}/{{$photo->id}}" class="btn btn-default">Редактировать</a></p>
                        </div>
                    </div> <!-- row -->
                    <hr/>
                    
                    @endforeach

                </div>
            </div>





        </div>
    </div>
</div>
@endsection
