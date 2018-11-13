@extends('layouts.app')

@section('title')
редактирование комментария
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Редактирование комментария</h1></div>

                <div class="panel-body">

                <form name="editcomment" method="post" action="{{ url('/editcomment')}}">
                    
                    @if(Auth::user()->id == $comment->user_id)
                    
                    <p><textarea name="text" class="form-control">{{ $comment->text }}</textarea></p>
                    <input type="hidden" name="id" value="{{ $comment->id }}">
                                    
                    @else
                    
                    <span class="warning">У вас нет прав на редактирование этого комментария!</span>
                
                    @endif
                    
                <p><button class="btn btn-success">Обновить информацию</button></p>

                {{ csrf_field() }}

                </form>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
