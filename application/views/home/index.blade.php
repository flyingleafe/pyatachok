@layout('master')

@section('content')
    
	<div class="main">
        <div class="slogan">Работа у вас, рабочие у нас!</div>
        <section class="for-worker">
			<a href="{{ URL::to('jobs') }}" class="big-button jobs">Найти работу</a>
		</section>
		<section class="for-employer">
			<a href="{{ URL::to('find-workers') }}" class="big-button workers">Найти рабочих</a>
		</section>
	</div>

@endsection
