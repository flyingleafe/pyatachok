@layout('master')

@section('content')




<div class="container">
    <h1>Найти рабочих</h1>

    @if($errors->has())
    {{ $errors->first('name', '<p>:message</p>') }}
    @endif


    {{ Form::open('search/workers', 'POST', array('class' => 'b-form')) }}

    <?  $jobtypes = Jobtype::All();  ?>

    @if($jobtypes)
    <div class="b-one__fieldset">
        <div class="b-jobtypes_inner">
            <h3>Выберите тип работ:</h3>
            <select id="select_job_types"  name="job_id" class="chzn-select">
                <option value="">Тип работ</option>
                <?foreach($jobtypes as $job){?>
                <option value="{{$job->id}}">{{$job->name}}</option>
                <?}?>
            </select>
        </div>

        <script type="text/javascript">
            $(function (){
                $("#select_job_types").chosen({
                    no_results_text: "Ничего не найдено",
                    placeholder_text: 'Выберите типы работ'
                });
            });
        </script>
    </div>
    @endif


    <div class="b-one__fieldset">
        {{ Form::label('name', 'Имя и Фамилия', array('class'=>''))    }}
        {{ Form::text('name', '')    }}
    </div>



    <div class="b-one__fieldset">
        {{ Form::label('created_at', 'На сайте', array('class'=>'' ))    }}
        {{ Form::text('created_at', '', array('id'=>'created_at'))    }}
    </div>

    <div class="b-one__fieldset">
        {{ Form::label('rating', 'Рейтинг', array('class'=>''))    }}
        {{ Form::text('rating', '')    }}
    </div>



    <h3>Бригада</h3>

    <div class="b-one__fieldset">
        {{ Form::label('team', 'Без разницы', array('class'=>''))    }}
        {{ Form::radio('team', '', array('checked'))    }}
    </div>

    <div class="b-one__fieldset">
            {{ Form::label('team', 'Нет', array('class'=>'',))    }}
            {{ Form::radio('team', 0)    }}
        </div>

    <div class="b-one__fieldset">
        {{ Form::label('team', 'Есть', array('class'=>'',))    }}
        {{ Form::radio('team', 1)    }}
    </div>

    <div class="b-one__fieldset">
        {{ Form::label('Возраст', 'Возраст', array('class'=>'' ))    }}
        {{ Form::text('age', ''  )    }}
    </div>


    <div class="b-one__fieldset">
        {{ Form::label('gender', 'Без разницы', array('class'=>''))    }}
        {{ Form::radio('gender', '', array('checked'))    }}
    </div>

    <div class="b-one__fieldset">
        {{ Form::label('gender', 'Женский', array('class'=>''))    }}
        {{ Form::radio('gender', 0)    }}
    </div>
    <div class="b-one__fieldset">
        {{ Form::label('gender', 'Мужской', array('class'=>'' ))    }}
        {{ Form::radio('gender', 1 )    }}
    </div>
gi
    <h3>Зарплата</h3>
    <div id="slider"></div>
    <div class="b-one__fieldset">
        {{ Form::label('cost_min', 'От', array('class'=>'',))    }}
        {{ Form::text('cost_min', '', array( 'id'=>'cost_min'))    }}
    </div>
    <div class="b-one__fieldset">
        {{ Form::label('cost_max', 'До', array('class'=>''))    }}
        {{ Form::text('cost_max', '', array( 'id'=>'cost_max'))    }}
    </div>


    {{ Form::submit('Искать', array('class'=>''))    }}

    {{ Form::close();}}

    <script type="text/javascript">
        $.datepicker.regional['ru'] = {
            closeText: 'Закрыть',
            prevText: '&#x3c;Пред',
            nextText: 'След&#x3e;',
            currentText: 'Сегодня',
            monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
                'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
            monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
                'Июл','Авг','Сен','Окт','Ноя','Дек'],
            dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
            dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
            dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
            weekHeader: 'Не',
            dateFormat: 'dd.mm.yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''};
        $.datepicker.setDefaults($.datepicker.regional['ru']);

        $(function() {
            $( "#created_at" ).datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                changeYear: true
            });


            $(function() {
                $("#slider").slider({
                    min: 0,
                    max: 10000,
                    values: [0,10000],
                    range: true,
                    stop: function(event, ui) {
                        jQuery("#cost_min").val(jQuery("#slider").slider("values",0));
                        jQuery("#cost_max").val(jQuery("#slider").slider("values",1));
                    },
                    slide: function(event, ui){
                        jQuery("#cost_min").val(jQuery("#slider").slider("values",0));
                        jQuery("#cost_max").val(jQuery("#slider").slider("values",1));
                    }
                });

            });
        });

    </script>

    @if(isset($workers))
    <div class="b-results">
        @foreach($workers as $worker)
        <div class="b-worker_name"><!--{{$worker->id}}--></div>
        <div class="b-worker_name"><b>{{$worker->jobtype_id}}</b></div>
        <div class="b-worker_name">{{$worker->name}}</div>
        <div class="b-worker_cost">{{$worker->phone}}</div>
        <div class="b-worker_cost">{{$worker->cost}}</div>
        @endforeach
    </div>
    @endif

</div>
@endsection