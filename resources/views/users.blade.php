@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Пользователи Фотоклуба</div>

                <div class="panel-body">

                @foreach($users as $user)

                <div class="col-md-3"><a href="{{ url('/') }}/user/{{$user->id}}">{{$user->name}}</a></div>

                @endforeach
                <div class="row"></div>

                <center>{{ $users->links() }}</center>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
