@extends('layouts.app')

@section('title')
@if ($seotitle)
{{ $seotitle }}
@elseif ($cat_name)
{{ $cat_name }}
@else
Фотоклуб Артема Кашканова
@endif
@endsection

@section('content')
<div class="container-fluid">
    
  {{--  <div class="jumbotron">
        <h3>{{ $cat_name }}</h3>
        {{ $cat_description }}
    </div>
    --}} 
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
                <div class="panel-heading">F.A.Q.
                </div>

                <div class="panel-body">
                    <p><a href="http://club.artem-kashkanov.ru/articles/3">Как вставить картинки в комментарии</a></p>
                    <p><a href="http://lori.ru/?ref=54711">Как заработать на новый объектив? ;)</a></p>
                    
                    
                    


                </div>
            </div>


            

            
                
            </div>
            



        
        <div class="col-sm-8">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    
                       <a href="{{route('addphoto')}}"><i class="fa fa-upload"></i> 
                        Загрузить фото</a>
                    
                    
                    
                </div>
                    
                <div class="panel-body">
                    <p>
                    <center>
                    <h3>{{ $cat_name }}</h3>
                    </center>
                    <hr>
                </p>
                    @foreach($photos as $photo)


                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 preview-block">
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
                    &nbsp;&nbsp;&nbsp;<i class="fa fa-thumbs-up"></i> {{ $photo->recCount() }}
                    </div>
                    </div>

                    @endforeach



                </div>

               <center>{{ $photos->links() }}</center>
               
    
               
            </div>
                            
            @include("ads.adsense")
                            
                            

            
            
    
    </div>
        <div class="col-sm-2">
            
                        <div class="panel panel-default">


                <div class="panel-body dark">
@include('widgets.weekphoto')
                    
                    
                    


                </div>
            </div>

        </div>
        </div>
    </div>
</div>
@endsection
