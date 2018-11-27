@extends('layouts.app')

@section('title')
Главная страница
@endsection

@section('content')
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
        </div>
        

        
        <div class="col-sm-9">
            <div class="panel panel-default">
                <div class="panel-heading">Фотографии</div>

                <div class="panel-body">

                    @foreach($photos as $photo)


                    <div class="col-sm-3 preview-block">
                    {{ $photo->name }}<br/>
                    <a href="{{ url('/') }}/photo/{{ $photo->id }}"><img src="{{ url('/') }}/photos/{{ $photo->user_id}}/_{{ $photo->url }}" class="preview"></a>
                    <br/>Просмотров: {{ $photo->views }}
                    <br/>Комментариев: {{ $photo->commentsCount() }}
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
