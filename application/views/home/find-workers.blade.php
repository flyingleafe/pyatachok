@layout('master')

@section('content')
    
    <div class="main">
        <div class="center">
            <div class="logo"></div>
            <h1 class="central">Выбирайте, как вам удобнее найти рабочих.</h1>
            <div class="buttons">
                <div class="big-button">
                    <a href="{{ URL::to('jobs/create') }}" class="job-add">Разместить вакансию</a>
                </div>
                <div class="big-button right">
                    <a href="{{ URL::to('workers') }}" class="big-button workers">Нанять рабочих прямо сейчас</a>
                </div>
            </div>
        </div>
    </div>

@endsection