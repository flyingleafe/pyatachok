@layout('master')

@section('content')

<div class="container">

    @if($errors->has())
    {{ $errors->first('name', '<p>:message</p>') }}
    @endif


    {{ Form::open('register/profile', 'POST', array('class' => 'b-user-register__form')) }}


    <div class="b-one__fieldset">
        {{ Form::label('jobtype_id', 'Тип работ' )    }}
        <?php  $jobtypes = Jobtype::All();  ?>
        <select id="select_job_types"  name="job_id" class="chzn-select">
            <option value="">Тип работ</option>
            <?foreach($jobtypes as $job){?>
            <option value="{{$job->id}}">{{$job->name}}</option>
            <?}?>
        </select>
    </div>



    <div class="b-one__fieldset">
        {{ Form::label('name', 'Ваше имя', array('class'=>''))    }}
        {{ Form::text('name', '',  array('id'=>'phone') )    }}
    </div>

    <div class="b-one__fieldset">
        {{ Form::label('price', 'Размер оплаты', array('class'=>''))    }}
        {{ Form::text('price', '',  array('id'=>'price') )    }}
    </div>

    <div class="b-one__fieldset">
        {{ Form::label('phone', 'Телефон', array('class'=>''))    }}
        {{ Form::text('phone', '',  array('id'=>'phone') )    }}
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
        {{ Form::text('time_start', '', array('id'=>'time_start'))    }}
    </div>

    <div class="b-one__fieldset">
        {{ Form::label('time_end', 'Дата окончания', array('class'=>''))    }}
        {{ Form::text('time_end', '', array('id'=>'time_end'))    }}
    </div>

    <div class="b-one__fieldset">
        {{ Form::label('target_count', 'Количество человек', array('class'=>''))    }}
        {{ Form::text('target_count', '')    }}
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
                timeFormat: "hh:mm tt"
            });

            $('#time_end').datetimepicker({
                timeFormat: "hh:mm tt"
            });
        });
    </script>
</div>

@endsection