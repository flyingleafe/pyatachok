@layout('master')

@section('content')
    
    @include('blocks.header-home')
	<div class="main">
		<div class="center">
			<div class="logo"></div>
            <div class="slogan">Работа у вас, рабочие у нас!</div>
			<div class="buttons">
				<a href="{{ URL::to('jobs') }}" class="big-button jobs">Найти работу</a>
				<a href="{{ URL::to('find-workers') }}" class="big-button workers">Найти рабочих</a>
			</div>
		</div>
	</div>

@endsection
