@layout('master')

@section('content')

    <div class="main">
        <div class="center">
            <div class="slogan">Выбирайте, как вам удобнее найти рабочих: </div>
            <div class="buttons">
                <div class="columns">
                    <div class="left-col">
                        <div class="big-button">
                            <img src="/img/left_man.png" class="man left-man" />
                            <a href="{{ URL::to('jobs/create') }}" class="job-add">Разместить вакансию</a>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="right-col">
                        <div class="big-button right">
                            <img src="/img/right_man.png" class="man right-man" />
                            <a href="{{ URL::to('workers') }}" class="workers">Нанять рабочих прямо сейчас</a>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>

@endsection