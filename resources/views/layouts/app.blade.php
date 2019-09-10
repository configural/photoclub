<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <link rel="icon" href="{{url('/')}}/favicon.ico" type="image/x-icon" />

<!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('/')}}/css/my.css">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <meta name="yandex-verification" content="4e35744005998cfa" />
    <style>
        body {
            font-family: 'Verdana';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style><!-- TinyMCE -->
<script type="text/javascript" src="{{url('/')}}/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
                language: "ru",
		//plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,",

		// Theme options
// Theme options
theme_advanced_buttons1 : "bold, italic,|, link, unlink, image",
theme_advanced_buttons2 : "",
theme_advanced_buttons3 : "",
theme_advanced_buttons4 : "",

theme_advanced_toolbar_location : "top",
theme_advanced_toolbar_align : "left",
//theme_advanced_statusbar_location : "bottom",
theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		//template_external_list_url : "lists/template_list.js",
		//external_link_list_url : "lists/link_list.js",
		//external_image_list_url : "lists/image_list.js",
		//media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->


<!-- Put this script tag to the <head> of your page -->
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?160"></script>

<script type="text/javascript">
  VK.init({apiId: 6897661, onlyWidgets: true});
</script>

</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Фотоклуб Артема Кашканова
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Моя страница</a></li>
                    <li><a href="{{ url('/comments') }}">Комментарии</a></li>
                    <li><a href="{{ url('/users') }}">Статистика</a></li>
                    <li><a href="{{ url('/rules') }}">Правила</a></li>
                    <li><a href="{{ url('/books') }}">Книги о фото</a></li>
                    <li><a href="{{ url('/software') }}">Программы для фото</a></li>
                    
                    <li><a href="{{ url('/contacts') }}">Контакты</a></li>
                    <li><a href="{{ url('/donate') }}"><i class="fa fa-money" style="color: orange"></i> Поддержать проект</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Войти</a></li>
                        <li><a href="{{ url('/register') }}">Зарегистрироваться</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }}, id[{{ Auth::user()->id }}] <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{url('/home')}}"><i class="fa fa-btn fa-user"></i>Моя страница</a></li>
                                <li><a href="{{url('/addphoto')}}"><i class="fa fa-btn fa-upload"></i>Загрузить фото</a></li>
                                <li><a href="{{url('/editprofile')}}"><i class="fa fa-btn fa-gear"></i>Редактировать профиль</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Выйти</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
<footer class="footer footer-inverse">
    <div class="container-fluid">
        
        <div class="row-fluid">
            
            <div class="col-sm-2"><a href="{{ url('/rules')}}">Правила Фотоклуба</a></div>
            <div class="col-sm-2"><a href="/terms.pdf">Пользовательское соглашение</a></div>
            <div class="col-sm-2"><a href="{{ url('/privacy')}}">Политика конфиденциальности</a></div>
            <div class="col-sm-2">Сайт использует cookies</div>
            <div class="col-sm-2">Возрастное ограничение 16+</div>
            <div class="col-sm-2">
                
                
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(52212658, "init", {
        id:52212658,
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/52212658" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
                
                &nbsp;
<!--LiveInternet counter--><script type="text/javascript">
document.write("<a href='//www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t12.2;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";h"+escape(document.title.substring(0,150))+";"+Math.random()+
"' alt='' title='LiveInternet: показано число просмотров за 24"+
" часа, посетителей за 24 часа и за сегодня' "+
"border='0' width='88' height='31'><\/a>")
</script><!--/LiveInternet-->

            </div>
        </div>
        
    </div>
</footer>
    
</body>
</html>
