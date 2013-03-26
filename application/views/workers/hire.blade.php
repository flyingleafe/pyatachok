@layout('master')

@section('before_assets')
    <script>
    var URLS = {
        workers_chosen : "{{ URL::to('workers/chosen') }}"
    }
    </script>
@endsection

@section('content')
    @include('blocks.header')
    <div class="b-content">
        <h1>Наем рабочих.</h1>
        <div class="workers-list">
            <h2>Вы собираетесь нанять этих рабочих:</h2>
            @include('blocks.worker-chosen-list-hb')
        </div>
        {{ Form::open('workers/confirm', 'POST', array('class' => 'b-form', 'id' => 'job-details') ) }}
            <h2>Информация о Вас и о работе</h1>
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
            @include('blocks.jobtypes')
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
            {{ Form::submit('Завершить') }}
        {{ Form::close() }}
    </div>

@endsection
