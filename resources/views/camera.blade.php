@extends('layouts.app')

@section('title')
{{$model}} - примеры фотографий
@endsection

@section('content')
<div class="container-fluid">
    
    <div>

        <h1>Фотографии, сделанные на {{$model}}</h1>
        <p>
            <a href="{{url('users')}}">Выбрать другую камеру</a>
            
            
        </p>
    </div>
    
</div>

<div class="container-fluid">
    <div class="row">
        


        
        <div class="col-sm-12">
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
