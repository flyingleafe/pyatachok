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

            <div class="main inner">
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
                    <style>
                        .action{
                            font-size: 11px;

                        }
                    </style>
                    <div class="b-one__fieldset">
                        {{ Form::label('price', 'Оплата на 1 рабочего в час: ') }}
                        <input type="text" value="200" name="price" id='price_for_one' style="width: 40px">
                        <a class="action increase" href="">Добавить</a>
                        <a class="action decrease" href="">Уменьшить</a>
                    </div>
                </div>
                <script>
                    $(function () {
                        $('.action').on('click', function(e){
                            e.preventDefault();
                            var price_for_one = $('#price_for_one');
                            var current = parseInt(price_for_one.val());
                            var delta = 100;
                            var max = 2000-delta;
                            var min = 100+delta;

                                if($(this).hasClass('increase') && current < max)
                                {
                                    var next = current+delta;
                                    price_for_one.val(next);
                                }
                                else if( $(this).hasClass('decrease') && current > min)
                                {
                                    var next = current-delta;
                                    price_for_one.val(next);
                                }

                            return false;

                        })

                    })

                </script>
                {{ Form::submit('Завершить', array('class'=>'red-button')) }}
            {{ Form::close() }}

            <div class="workers-list" style="float:left">
                @include('blocks.worker-chosen-list-hb')
            </div>
            </div>
        </div>
    </div>

@endsection
