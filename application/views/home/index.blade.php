@layout('master')

@section('content')

	<header>
		<nav class="top">
			<ul class="menu">
				<li>Раз</li>
				<li>Два</li>
			</ul>
		</nav>
        <div class="account">
            @if(Auth::check())
                <a class="link-to profile" href="{{ URL::to('profile') }}"> {{Auth::user()->phone}}</a>
                <a class="link-to logout" href="{{ URL::to('logout') }}">Выйти</a>
            @else
                <a class="link-to register" href="{{ URL::to('register') }}">Войти или зарегистрироваться</a>
            @endif
        </div>
	</header>
	<div class="main">
		<div class="center">
			<div class="logo"></div>
            <div class="slogan">Работа у нас, рабочие у вас!</div>
			<div class="buttons">
				<a href="{{ URL::to('jobs') }}" class="big-button jobs">Найти работу</a>
				<a href="{{ URL::to('workers') }}" class="big-button workers">Найти рабочих</a>
			</div>
		</div>
	</div>

@endsection
