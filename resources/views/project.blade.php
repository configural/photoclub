@extends('layouts.app')

@section('title')
Фотопроект - {{ $project->name }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row-fluid height50">

        <div class="col-md-12">

            <h1>{{ $project->name }}</h1>
            <i><p>Администратор проекта: 
                    @if ($project->user)
                    <a href="{{url('/user')}}/{{ $project->user->id}}">{{ $project->user->name}}</a>.
                    @else 
                    Пользователь удален.
                    @endif
                    @if ($project->is_private) 
                    Это частный проект. В нем только авторские фотографии.
                    @else
                    Это публичный проект. В него могут присылать фотографии все зарегистрированные пользователи.
                    @endif
                </p></i>

            <p>
                {!! $project->description!!}
            </p>

            @if (Auth::user() and Auth::user()->id == $project->user_id)
            <a href="{{ url('/project/edit') }}/{{$project->id}}" class="btn btn-success">Редактировать</a>
            @endif

            <p>
                <script src="https://yastatic.net/share2/share.js"></script>
            <div class="ya-share2" data-curtain data-size="l" data-shape="round" data-services="messenger,vkontakte,facebook,odnoklassniki,telegram"></div>
            </p>

            @foreach($photos as $photo)
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="project_photo" data-id="{{$photo->id}}" 
                     data-src="{{url('/')}}/photos/{{ $photo->user_id }}/{{$photo->url}}"
                     data-user="{{$photo->user->name}}"
                     data-name="{{$photo->name}}"
                     >
                    <div class="photo_label">
                        <i class="fa fa-user"></i> {{ $photo->user->name }}
                    </div>
                    <img src="{{url('/')}}/photos/{{ $photo->user_id }}/{{$photo->url}}" 
                         alt="Фотография - {{ $photo->name}}, автор - {{ $photo->user->name }}" 
                         class="photo" style="cursor:pointer" id="" title="">

                </div>


            </div>
            @endforeach
            <div class="clearfix"></div>
            <p>
                {{ $photos->links() }}
            </p>





        </div>
    </div>
</div>

<div id="fullscreen" style="
     display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.9); z-index: 1000;
     color: white; text-align: center;
     ">


</div>

<script>
$(".project_photo").click(function () {
    var h = $(window).height() * 0.9;
    var w = $(window).width() * 0.9;
    $("#fullscreen").show();
    $("#fullscreen").html("<img class='fullscreenImage' src=" + $(this).data('src') + "><p>" + $(this).data('user') + ": " + $(this).data('name') + "</p>");
        });

        $("#fullscreen").click(function () {
            $("#fullscreen").hide();
        });
</script>


<script>
    $(".project_photo").mouseover(function () {
        $(this).children(".photo_label").toggle();
    });

    $(".project_photo").mouseout(function () {
        $(this).children(".photo_label").toggle();
    });
    </script>

    <style>
        .fullscreenImage {
            display: block;
            max-height: 90%;
            max-width: 95%;
            margin: 20px auto;
            border: 2px solid white !important;
            cursor:pointer;
            
        }
    </style>
    @endsection
