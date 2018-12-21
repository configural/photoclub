@extends('layouts.app')

@section('title')
На что мы снимаем?

@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        <div class="jumbotron"><h2>Статистика Фотоклуба</h2></div>
        </div>
        
        <div class="col-md-4">
         <h3>Самые активные пользователи</h3>
            
            <table class="table table-bordered">
                    <tr>
                        <th>Пользователь</th>
                        <th>Количество фото</th>
                    </tr>
           @foreach($users as $user)
           <tr>
               <td><a href="{{url('/')}}/user/{{$user->user_id}}">{{$user->name}}</a></td>
                       <td><span class="bar" style="width: {{$user->count}}px;">{{$user->count}}</span></td>
           </tr>

           @endforeach
            </table>
        </div>
        
        <div class="col-md-4">
            
            <h3>На какие камеры мы снимаем</h3>
            
            <table class="table table-bordered">
                    <tr>
                        <th>Модель</th>
                        <th>Количество фотографов</th>
                    </tr>
           @foreach($cameras as $camera)
           <tr>
               <td><a href="{{url('/')}}/camera/{{$camera->Model}}">{{$camera->Model}}</a></td>
                       <td><span class="bar" style="width: {{$camera->count}}px;">{{$camera->count}}</span></td>
           </tr>

           @endforeach
            </table>
            
        </div>
        <div class="col-md-4">
            <h3>В каких режимах мы снимаем</h3>
            
                        <table class="table table-bordered">
                    <tr>
                        <th>Режим</th>
                        <th>Количество фото</th>
                    </tr>
           @foreach($modes as $mode)
           <tr>
               <td>
                   
                   {{ $modesList[$mode->ExposureProgram] }}
                   
                </td>
                       <td><span class="bar" style="width: {{$mode->count}}px;">{{$mode->count}}</span></td>
           </tr>

           @endforeach
            </table>
            
        </div>
        
    </div>
</div>
@endsection
