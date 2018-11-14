           
@if(Auth::user())
<div class="panel panel-default">
                <div class="panel-heading">Мой профиль</div>

                <div class="panel-body">
                    
                    @if(Auth::user()->avatar) 
                    <p><a href="{{ url('/home')}}"><img src="{{ url('/') }}/photos/{{Auth::user()->id}}/avatar.jpg" class="preview"></a></p>
                    @else 
                    <div class="no_avatar">Нет аватара</div>
                    @endif
                    
                    
                    @if(Auth::user()->name)
                    <p><a href="{{ url('/home')}}">{{ Auth::user()->name }}</a>, добро пожаловать!</p>
                    @else
                    <p>Вы успешно вошли в систему! Пожалуйста, укажите свое имя в настройках профиля!</p>
                    @endif
                    
                    
                   


                </div>
            </div>
@else
<div class="panel panel-default">
                <div class="panel-heading">О проекте</div>
                
                <div class="panel-body">
                    <p><strong>Фотоклуб Артема Кашканова</strong> – независимое сообщество фотолюбителей, объединенных общими интересами и действующее по своим правилам.</p>
                    <p>Участие в Фотоклубе добровольное.</p>
                    <p>Цель Фотоклуба - обсуждение присланных фотографий и получение конструктивной критики.</p>
                    <p>Проект не является фотохостингом и не гарантирует вечного хранения присланных фотографий.</p>
                </div>
</div>               

@endif