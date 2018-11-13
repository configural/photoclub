@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        
        <div class="col-sm-2">
            @include('layouts.usermenu')

        </div>
        <div class="col-sm-10">
            <div class="panel panel-default">
                <div class="panel-heading">Фотографии</div>

                <div class="panel-body">

                    @foreach($photos as $photo)


                    <div class="col-sm-3 preview-block">
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
