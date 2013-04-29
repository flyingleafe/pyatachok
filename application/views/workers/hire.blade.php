@layout('master')

@section('before_assets')
    <script>
    var URLS = {
        workers_chosen : "{{ URL::to('workers/chosen') }}"
    }
    </script>
@endsection

@section('content')
    <div class="inner">
        <div class="b-content">
            <div class="slogan">Наем рабочих. </div>

            {{ Form::open('workers/confirm', 'POST', array('class' => 'b-form', 'id' => 'job-details', 'class'=>'job-info') ) }}
                <h1>Информация о Вас и о работе</h1>
                <div class="job-info__form">
                    <?php if( Auth::check() ) {
                        $name = Auth::user()->name;
                        $phone = Auth::user()->phone;
                    } else {
                        $name = $phone = '';
                    } ?>
                    <div class="b-one__fieldset">
                        {{ Form::label('name', 'Ваше имя') }}
                        {{ Form::text('name', $name, array('required')) }}
                    </div>
                    <div class="b-one__fieldset">
                        {{ Form::label('phone', 'Ваш телефон') }}
                        {{ Form::text('phone', $phone, array('required')) }}
                    </div>

                    <div class="b-one__fieldset">
                        {{ Form::label('phone', 'Тип работ') }}
                        @include('blocks.jobtypes')
                    </div>

                    <div class="b-one__fieldset">
                        {{ Form::label('place', 'Место работы') }}
                        {{ Form::text('place', '', array('required')) }}
                    </div>
                    <div class="b-one__fieldset">
                        {{ Form::label('time_start', 'Время работы: от') }}
                        {{ Form::text('time_start', '', array('required')) }}
                        {{ Form::label('time_end', 'до') }}
                        {{ Form::text('time_end', '', array('required')) }}
                    </div>
                    <div class="b-one__fieldset">
                        {{ Form::label('price', 'Оплата на 1 рабочего') }}
                        {{ Form::number('price', '', array('required')) }}
                    </div>
                </div>
                {{ Form::submit('Завершить', array('class'=>'red-button')) }}
            {{ Form::close() }}
            <div class="workers-list" style="float:left">
                @include('blocks.worker-chosen-list-hb')
            </div>
        </div>
    </div>

@endsection
