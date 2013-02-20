@layout('master')

@section('content')
	<header>
		<nav class="top">
			<ul class="menu">
				<li>Раз</li>
				<li>Два</li>
				<li>Три</li>
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
