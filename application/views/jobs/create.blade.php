@layout('master')

@section('content')

<div class="container">

    @if( isset($errors))
        {{ $errors->first('phone', '<p>:message</p>') }}
        {{ $errors->first('jobtype_id', '<p>:message</p>') }}
        {{ $errors->first('price', '<p>:message</p>') }}
        {{ $errors->first('description', '<p>:message</p>') }}
        {{ $errors->first('place', '<p>:message</p>') }}
        {{ $errors->first('time_start', '<p>:message</p>') }}
        {{ $errors->first('time_end', '<p>:message</p>') }}
        {{ $errors->first('target_count', '<p>:message</p>') }}
    @endif

    {{ Form::open('jobs/create', 'POST', array('class' => '')) }}

    <div class="b-one__fieldset">
        @include('blocks.jobtypes')
    </div>

    <div class="b-one__fieldset">
        {{ Form::label('name', 'Ваше имя', array('class'=>''))    }}
        {{ Form::text('name', $model->name,  array('id'=>'phone') )    }}
    </div>

    <div class="b-one__fieldset">
        {{ Form::label('price', 'Размер оплаты', array('class'=>''))    }}
        {{ Form::text('price', '',  array('id'=>'price') )    }}
    </div>

    <div class="b-one__fieldset">
        {{ Form::label('phone', 'Телефон', array('class'=>''))    }}
        {{ Form::text('phone', $model->phone,   array('id'=>'phone') )    }}
    </div>

    <div class="b-one__fieldset">
        {{ Form::label('description', 'Описание', array('class'=>''))    }}
        {{ Form::textarea('description', '',  array('id'=>'description') )    }}
    </div>

    <div class="b-one__fieldset">
        {{ Form::label('place', 'Место проведения', array('class'=>''))    }}
        {{ Form::text('place', '',  array('id'=>'place') )    }}
    </div>


    <div class="b-one__fieldset">
        {{ Form::label('time_start', 'Дата начала', array('class'=>''))    }}
        {{ Form::text('time_start', '', array('id'=>'time_start', ))    }}
    </div>

    <div class="b-one__fieldset">
        {{ Form::label('time_end', 'Дата окончания', array('class'=>''))    }}
        {{ Form::text('time_end', '', array('id'=>'time_end', ))    }}
    </div>

    <div class="b-one__fieldset">
        {{ Form::label('target_count', 'Количество человек', array('class'=>''))    }}
        {{ Form::select('target_count', array(1,2,3,4,5,6,7))    }}
        <p>Большее количество участников доступно в платном режиме</p>
    </div>

    {{ Form::submit('Создать', array('class'=>''))    }}

    {{ Form::close();}}
    <script>
        $(function(){

            $("#select_job_types").chosen({
                no_results_text: "Ничего не найдено",
                placeholder_text: 'Выберите типы работ'
            });

            $('#time_start').datetimepicker({
                dateFormat: "dd-MM-yy",
                timeFormat: "HH:mm"
            });

            $('#time_end').datetimepicker({
                dateFormat: "dd-MM-yy",
                timeFormat: "HH:mm"
            });
        });
    </script>
</div>

@endsection