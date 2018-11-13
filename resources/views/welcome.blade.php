@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Добро пожаловать!</div>

                <div class="panel-body">

                    @foreach($photos as $photo)


                    <div class="col-md-3 preview-block">
                    {{ $photo->name }}<br/>
                    <a href="{{ url('/') }}/photo/{{ $photo->id }}"><img src="{{ url('/') }}/photos/{{ $photo->user_id}}/{{ $photo->url }}" class="preview"></a>
                    </div>

                    @endforeach



                </div>

               <center>{{ $photos->links() }}</center>
            </div>
        </div>
    </div>
</div>
@endsection
