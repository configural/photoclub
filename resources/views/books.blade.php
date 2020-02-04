@extends('layouts.app')

@section('title')
Книги «О фотографии простым языком» - Артем Кашканов. Скачать, купить.
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            
            <h1>Электронные книги о фотографии</h1>
            
            <p class="lead">В этом разделе вы можете за разумную цену приобрести электронные книги о фотографии. Вы получите интересные и полезные материалы и заодно поддержите проект &laquo;Фотоклуб Артема Кашканова&raquo;!</p>
            <p>
                Книги ориентированы в первую очередь на начинающих фотолюбителей, желающих разобраться в тонкостях фотодела. Они написаны простым доступным языком и вы найдете в них ответы практически на все вопросы, касающиеся фотографии.
            </p>
            <p>
                После оплаты вы получите на электронную почту ссылку для скачивания материала. Вы ничем не рискуете - если книга вам не понравится (что маловероятно), у вас есть возможность вернуть потраченные деньги в течение 24 часов с момента оплаты.
            </p>
            <p>Если у вас есть какие-то вопросы, касающиеся приобретения электронных книг, или возникли проблемы с доставкой электронных писем обращайтесь, мы решим все вопросы!
            </p>
            <p><a href="{{url('/contacts')}}" class="btn btn-primary">Перейти в раздел &laquo;Контакты&raquo;</a>
            </p>
            
    <script>!function(e){var l=function(l){return e.cookie.match(new RegExp("(?:^|; )digiseller-"+l+"=([^;]*)"))},i=l("lang"),s=l("cart_uid"),t=i?"&lang="+i[1]:"",d=s?"&cart_uid="+s[1]:"",r=e.getElementsByTagName("head")[0]||e.documentElement,n=e.createElement("link"),a=e.createElement("script");n.type="text/css",n.rel="stylesheet",n.id="digiseller-css",n.href="//shop.digiseller.ru/xml/store2_css.asp?seller_id=823383",a.async=!0,a.id="digiseller-js",a.src="//www.digiseller.ru/store2/digiseller-api.js.asp?seller_id=823383"+t+d,!e.getElementById(n.id)&&r.appendChild(n),!e.getElementById(a.id)&&r.appendChild(a)}(document);</script>

    <span class="digiseller-body" id="digiseller-body" data-partner-id="" data-cat="0" data-logo="0" data-downmenu="0" data-purchases="1" data-langs="0" data-cart="1" data-search="0"></span>




        </div>
    </div>
</div>
@endsection
