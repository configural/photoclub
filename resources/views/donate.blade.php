@extends('layouts.app')

@section('title')
Правила фотоклуба
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            
            <div class="jumbotron"><h2>Финансовая поддержка Фотоклуба</h2></div>
            
            
        </div>
    </div>
    <div class="row height50" >
        <div class="col-md-1 col-md-offset-2">
             <img src="{{ url('/')}}/photos/3/avatar.jpg" class="avatar">
        </div>
            
            <div class="col-md-4">
            
            <p>
                Дорогие друзья! Фотоклуб существует за счет моих личных финансов. 
                С точки зрения коммерции это убыточный проект. Даже несмотря на размещение рекламы  доходы от нее копеечные и не покрывают даже десятую долю стоимости хостинга. 
            </p>
            <p>Если у вас вдруг возникнет желание оказать посильную финансовую помощь проекту, я буду очень благодарен! </p>
            <p>
                Пожертвование - вещь сугубо добровольная. Сумма может быть любая, главное - чтобы лично для вас она не была обременительной.
            </p>
    </div>
        <div class="col-md-3">
            
            
            <p><strong>Яндекс.деньги, любая банковская карта</strong><br>
                <iframe src="https://money.yandex.ru/quickpay/button-widget?targets=%D0%9F%D0%BE%D0%B4%D0%B4%D0%B5%D1%80%D0%B6%D0%BA%D0%B0%20%D0%A4%D0%BE%D1%82%D0%BE%D0%BA%D0%BB%D1%83%D0%B1%D0%B0&default-sum=100&button-text=14&any-card-payment-type=on&button-size=m&button-color=orange&successURL=&quickpay=small&account=4100153405575&" width="284" height="36" frameborder="0" allowtransparency="true" scrolling="no"></iframe>
            <p><strong>PayPal</strong><br>
                <a href="https://paypal.me/kashkanov" target="_blank"><img src="{{ url('/')}}/images/paypal.png"></a>
            </p>
        
    </div>
</div>
@endsection
