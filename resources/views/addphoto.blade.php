@extends('layouts.app')

@section('title')
загрузка фотографии
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Загрузка фотографии</h1></div>

                <div class="panel-body">
@if ($limit >=10)
<div class="alert alert-danger">    За прошедшие 10 дней Вы загрузили {{ $limit }} фотографий из 10 возможных. Ваш лимит временно исчерпан.</div>
                    
@else  
<div class="alert alert-success">За прошедшие 10 дней Вы загрузили {{ $limit }} фотографий из 10 возможных.</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    

                <form name="editcomment" method="post" action="{{ route('Photo.upload') }}" enctype="multipart/form-data">
                    <p><label>Название фотографии: </label>
                        <input name="name" class="form-control" type="text" required></p>
                    
                    <p><label>Категория: </label>
                        <select name="category_id" class="form-control">
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                        </select>
                    <p><label>Прикрепить файл: </label>
                        <input name="file" class="form-control" type="file" required="">
                    <p>Допустимый тип файла - JPEG, максимальный размер - 16 мегабайт. Рекомендуемый цветовой профиль - <strong>sRGB</strong>.</p>
                    <p>При загрузке полноразмерной фотографии она будет отмасштабирована до разрешения 1440 пикселей по длинной стороне, при этом возможна потеря качества (уровень сжатия - 80%). Если для вас это критично, рекомендуется заранее уменьшать фото до этого разрешения.</p>


                    
                    <p><label>Описание фотографии:</label>
                        <textarea name="description" class="form-control" placeholder="История, связанная с фотографией, условия съемки, настройки, использованная техника - все что угодно."></textarea>
                    </p>
                    
                    

                    
                                        <p><label>Ссылка на полноразмерное изображение (на другом сервисе): </label> Если вас не устраивает ограничение на размер картинки в 1440 пикселей, вы можете указать ссылку на полноразмерное изображение на Flickr или другом сервисе. Под вашей работой появится ссылка для его просмотра в новом окне.
                                            
                        <input name="fullsize" class="form-control" type="text" placeholder="http://........./photo123456.jpg">
                                        <br/></p>
                    
                                        <p>
                        <fieldset class="height50">
                            <legend>Отношение к критике</legend>
                                <p><input name="critic_level" type="radio" value="2" required> <strong>Очень хочу критики!</strong> Разрешаю критиковать работу и придираться ко всем мелочам. Гарантирую адекватную реакцию на негативные комментарии.</p>
                                <p><input name="critic_level" type="radio" value="1"> <strong>Нейтральное отношение к критике</strong>. Просто интересно мнение со стороны, готов(а) к конструктивному общению. Если нечего сказать по существу, лучше пройдите мимо.</p>
                                <p><input name="critic_level" type="radio" value="0"> &laquo;<strong>Я так вижу</strong>&raquo; Не надо негатива!</p>
                        </fieldset>
                    </p>
                                        
                                        
                <p><button class="btn btn-success">Загрузить фотографию</button></p>
                                
                {{ csrf_field() }}

                </form>

@endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
