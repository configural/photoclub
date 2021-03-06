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
                       
            @if (Auth::user()->status == 4)            
            <div class="panel panel-default">
                        <div class="panel-heading">Мои статьи</div>

                        <div class="panel-body">
                            
                            @foreach($articles as $a) 
                            <a href="{{url('/')}}/articles/{{$a->id}}">{{ $a->name }}</a> {!! $a->description!!}
                            @endforeach
                            
                            <a href="{{url('/addarticle')}}" class="btn btn-lg btn-primary">Написать статью</a>
                            
                        </div>
                        </div>
            @endif
            
            
            <div class="panel panel-default">
                <div class="panel-heading">Мои фотографии</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-4"><a href="{{url('/addphoto')}}" class="btn btn-lg btn-primary">Загрузить фотографию</a></div>
                        <div class="col-sm-8">Рекомендуемый объем загрузки - 1 фото в день.<br/>
                        Приветствуется публикация художественных фотографий, представляющих интерес для широкой аудитории.
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
                                <p>Рекомендаций: {{$photo->recCount()}}</p>
                                
                                <p><a href="{{url('editphoto')}}/{{$photo->id}}" class="btn btn-default">Редактировать</a></p>
                        </div>
                    </div> <!-- row -->
                    <hr/>
                    
                    @endforeach

                
                
                               <center>{{ $photos->links() }}</center>

                
                </div>
            </div>





        </div>
    </div>
</div>
@endsection
