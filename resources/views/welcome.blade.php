@extends('layouts.app')

@section('title')
@if ($seotitle)
{{ $seotitle }}
@elseif ($cat_name)
{{ strip_tags($cat_name) }}
@else
Диафрагма 8. Клуб любителей пейзажной фотографии
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

@include('widgets.forum')  

<div class="panel panel-default">
                                    <div class="panel-heading">Фотопроекты



                                        @if (Auth::user())
                                        @if (Auth::user()->photos()->count() >= 20)
                                        <a href="{{ route('add_project')}}" class="btn btn-xs btn-default">Создать</a>
                                        @endif
                                        @endif
                                    </div>
                                    <div class="panel-body">
                                        @foreach(\App\Project::where('active', 1)->orderby('name')->get() as $p)
                                        @if ($p->photos->count())
                                        <p><i class="fa fa-camera red"></i> <a href="{{ url('/project')}}/{{$p->id}}">{{ $p->name }}</a></p>
                                        @endif
                                        @endforeach
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
                                        <div class="container-fluid">
                                            <div class="row-fluid">
                                                <div class="col-lg-3"><h2 class="cat_name">{!! $cat_name!!}</h2>
                                                </div>
                                                <div class="col-lg-9">{{ $cat_description }}</div>
                                            </div>
                                        </div>
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
                                <center>                            
                                    <!-- SAPE RTB DIV 600x340 -->
                                    <div id="SRTB_765229"></div>
                                    <!-- SAPE RTB END -->
                                </center>        





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
