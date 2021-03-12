@extends('layouts.app')

@section('title')
Поддержать проект
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            
            <div class="jumbotron"><h2>Финансовая поддержка Фотоклуба</h2></div>
            
            
        </div>
    </div>
    <div class="row height50" >
        <div class="col-md-2 col-md-offset-2">
             <img src="{{ url('/')}}/photos/3/avatar.jpg" class="avatar">
        </div>
            
            <div class="col-md-6">
            
            <p>
                Дорогие участники! Фотоклуб существует за счет моих личных финансов. 
                С точки зрения коммерции это убыточный проект. 
                Даже несмотря на размещение рекламы  доходы от нее копеечные и не покрывают даже десятую долю стоимости хостинга. 
            </p>
            <p>Если у вас вдруг возникнет желание оказать посильную финансовую помощь проекту, я буду очень благодарен! </p>
            <p>
                Пожертвование - вещь анонимная и сугубо добровольная. 
                Сумма может быть любая, главное - чтобы лично для вас она не была обременительной.
            </p>

            
            <br/>
            <p><strong>Яндекс.деньги, любая банковская карта</strong><br>
                <a href="https://yasobe.ru/na/na_razvitie_fotokluba" target="_blank" class="btn btn-warning">Страница сбора денег</a>
            <br/>
            <p><strong>PayPal</strong><br>
                <a href="https://paypal.me/kashkanov" target="_blank"  class="btn btn-primary">Страница сбора денег</a>
            </p>
        
    </div>
</div>
@endsection
