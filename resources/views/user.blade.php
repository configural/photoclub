@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        @if($user->name)
                        {{ $user->name }}
                        @else
                        id{{ $user->id }}
                        @endif
                    
                    </h1></div>

                <div class="panel-body">



                @foreach($photo as $p)


                   <div class="col-md-3 preview-block">
                   {{$p->name}}<br/>
                   <a href="/public/photo/{{ $p->id }}"><img src="/public/photos/{{$p->user_id}}/{{$p->url}}" class="preview"></a>
                   <br/>
                   Просмотров: {{$p->views}}
                   </div>

                @endforeach

                <div class="row">

                </div>
                <center>{{ $photo->links() }}</center>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
