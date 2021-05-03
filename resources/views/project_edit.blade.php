@extends('layouts.app')

@section('title')
Фотопроект - редактирование
@endsection

@section('content')
<div class="container-fluid">
    <div class="row height50">

        <div class="col-md-8 col-md-offset-2">
            
            <h1>Создание фотопроекта</h1>
            <p>
            <form method="post"  action="{{ url('/project_save')}}">
                <p><label>Название проекта</label><br/>
                    
                    <input type="hidden" name="id" value="{{ $project->id }}">
                    <input type="text" class="form-control" name="name" value="{{ $project->name }}"></p>
                
               <p><label>Описание проекта</label><br/>
                    <textarea class="form-control" name="description">{{ $project->description }}</textarea> 
               </p>
               
               <p>
                   <label>Тип проекта</label><br/>
                   @if ($project->is_private)
                   <input name="is_private" type="radio" value="1" checked> Частный (только я могу добавлять фотографии в проект)<br>
                   <input name="is_private" type="radio" value="0"> Публичный (фотографии в проект может добавлять кто угодно)<br>
                   @else
                   <input name="is_private" type="radio" value="1"> Частный (только я могу добавлять фотографии в проект)<br>
                   <input name="is_private" type="radio" value="0" checked> Публичный (фотографии в проект может добавлять кто угодно)<br>
                   @endif
               </p>
               
            <p>
            @if (Auth::user()->id == $project->user_id)
            <button class="btn btn-success">Обновить фотопроект</button>
            {{ csrf_field() }}
            @endif
            </p>
            </form>
            </p>


        </div>
    </div>
</div>
@endsection
