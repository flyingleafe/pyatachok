<div class="account">
    @if(Auth::check())
        <a title="Личный кабинет" class="link-to profile" href="{{ URL::to('profile') }}"> {{Auth::user()->phone}}</a>
        <a title="Выход" class="link-to logout" href="{{ URL::to('logout') }}">Выйти</a>
    @else
        <a class="link-to register" href="{{ URL::to('register') }}">Войти или зарегистрироваться</a>
    @endif
</div>
