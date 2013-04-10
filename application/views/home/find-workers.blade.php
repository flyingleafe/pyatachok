@layout('master')

@section('content')
    
    <div class="main">
        <div class="center">
            <div class="logo"></div>
            <h1 class="central">Выбирайте, как вам удобнее найти рабочих.</h1>
            <div class="buttons">
                <a href="{{ URL::to('jobs/create') }}" class="big-button job-add">Разместить вакансию</a>
                <a href="{{ URL::to('workers') }}" class="big-button workers">Нанять рабочих прямо сейчас</a>
            </div>
        </div>
    </div>

@endsection