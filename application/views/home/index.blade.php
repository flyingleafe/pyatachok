@layout('master')

@section('after_assets')
    <script src="js/jquery.slides.min.js"></script>
    <link href="/css/slider.css" media="all" type="text/css" rel="stylesheet">
@endsection

@section('content')
	<div class="main">
        <div class="slogan">Работа у вас, рабочие у нас!</div>
        <div class="buttons">
            <div class="columns">
                <div class="left-col">

                    <div class="big-button">
                        <img src="/img/left_man.png" class="man left-man" />
                        <a href="{{ URL::to('find-workers') }}" class=" workers">Найти рабочих</a>
                    </div>
                    <div class="clear"></div>
                    <div class="one-section">
                        <h1>Нужны Рабочие?</h1>
                        <p>Просто Найдите нужных вам людей в
                            считанные минуты на
                            Пятачок-онлайн!
                        </p>
                        <img src="/img/need_workers.png" class="need-workers"/>
                    </div>

                    <div class="one-section">
                        <h1>Не можете выбрать?</h1>
                        <p>Не знаете, кто именно вам нужен?
                            Разместите свою вакансию на нашем сайте, чтобы рабочие сами нашли вас!</p>
                    </div>
                </div>
                <div class="vertical-line"></div>
                <div class="right-col">
                    <div class="big-button right">
                        <img src="/img/right_man.png" class="man right-man" />
                        <a href="{{ URL::to('jobs') }}" class="jobs">Найти работу</a>
                    </div>
                    <div class="clear"></div>
                    <div class="one-section">
                        <h1>Желаете подзаработать?</h1>
                        <p>Расскажите об этом работадателям:
                            Зарегистрируйтесь и оставьте свою анкету на нашем сайте. Вас увидят сотни работодателей нуждающихся в вас!</p>
                    </div>

                    <div class="one-section">
                        <h1> Нужна работа прямо сейчас?</h1>
                        <p>Вы можете найти ее в списке  отличных вакансий!</p>
                    </div>

                </div>
                <div class="clear"></div>
            </div>
        </div>
	</div>
@endsection
