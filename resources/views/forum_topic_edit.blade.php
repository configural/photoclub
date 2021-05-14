@extends('layouts.app')

@section('title')
Редактирование темы
@endsection

@section('content')
<div class="container-fluid">
    <div class="row height50">

        <div class="col-md-8 col-md-offset-2">
            
            @php
            $topic = \App\Topic::where('id', $id)->where('user_id', Auth::user()->id)->first();
            @endphp
            <form method="post" action="{{route('save_topic')}}">
                <input type="hidden" name="id" value="{{$id}}">
                <p>
                <label>Назавание темы</label>
                <input type='text' name='name' value='{{$topic->name}}' class='form-control'>
                </p>
                <p><textarea class="form-control auto-height" name="text" style='height: 500px;'>{{ $topic->text}}</textarea></p>
                
                
                <p>
                    @if ($topic->active)
                        <p><input type='radio' name='active' value='1' checked> Тема открыта &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type='radio'  name='active' value='0'> Тема закрыта</p>
                    @else
                    <p><input type='radio' name='active' value='1'> Тема открыта &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type='radio'  name='active' value='0' checked> Тема закрыта</p>
                    @endif
                </p>
                {{ csrf_field() }}
            
                <p><button class="btn btn-success">Отправить</button></p>
            
            </form>

        </div>
    </div>
</div>



@endsection
