@extends('layouts.app')

@section('title')
@if ($cat_name)
{{ $cat_name }} - 
@endif
Фотоклуб Артема Кашканова
@endsection

@section('content')
<div class="container-fluid">
    
    <div class="jumbotron">
        <h3>{{ $cat_name }}</h3>
        {{ $cat_description }}
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
                <div class="panel-heading">{{ $cat_name }}</div>
                    
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
                    &nbsp;&nbsp;&nbsp;<i class="fa fa-thumbs-up"></i> {{ $photo->recCount() }}
                    </div>
                    </div>

                    @endforeach



                </div>

               <center>{{ $photos->links() }}</center>
               
    
               
            </div>
                            
            @include("ads.adsense")
                            
                            
      {{--          <div class="panel panel-default">
                    <div class="panel panel-heading">Форум "Неформат" - прямой эфир</div>
                    <div class="panel panel-body">
                        @php
                        echo file_get_contents(url('/').'/neformat');
                        @endphp
                    </div>
                </div>--}}
            
            
    
    </div>
        </div>
    </div>
</div>
@endsection
