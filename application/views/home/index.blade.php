@layout('master')

@section('content')

	<header>
		<nav class="top">
			<ul class="menu">
				<li>Раз</li>
				<li>
                    @if(Auth::check())
                    <a href="{{URL::to('register/index') }}"> {{Auth::user()->phone}}</a>
                    @else  <a href="{{URL::to('register.index') }}">Войти</a>
                    @endif
                </li>
				<li>
                    @if(Auth::check())
                    <a href="{{URL::to('register/logout') }}">Выйти</a>
                    @endif
                </li>
			</ul>
		</nav>
	</header>
	<div class="main">
		<div class="center">
			<div class="logo"></div>
			<div class="buttons">
				<a href="/jobs" class="big-button jobs">Найти работу</a>
				<a href="/workers" class="big-button workers">Найти рабочих</a>
			</div>
		</div>
	</div>
@endsection
