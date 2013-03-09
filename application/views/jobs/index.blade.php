@layout('master')

@section('content')
<div class="container">
    <h1>Найти работу</h1>

    @if($errors->has())
    {{ $errors->first('name', '<p>:message</p>') }}
    @endif


    {{ Form::open('register/profile', 'POST', array('class' => 'b-form')) }}

    <?  $jobtypes = Jobtype::All();  ?>

    @if($jobtypes)
    <div class="b-one__fieldset">
        <div class="b-jobtypes_inner">
            <h3>Выберите типы работ:</h3>
            <select id="select_job_types" class="chzn-select" multiple>
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
        {{ Form::label('rating', 'Рейтинг', array('class'=>''))    }}
        {{ Form::text('rating', '')    }}
    </div>

    <div class="b-one__fieldset">
        {{ Form::label('team', 'Бригада', array('class'=>'' ))    }}
        {{ Form::checkbox('team', 1  )    }}
    </div>

    <div class="b-one__fieldset">
        {{ Form::label('gender', 'Женский', array('class'=>''))    }}
        {{ Form::radio('gender', 0)    }}
    </div>
    <div class="b-one__fieldset">
        {{ Form::label('gender', 'Мужской', array('class'=>'' ))    }}
        {{ Form::radio('gender', 1, array('checked') )    }}
    </div>

    <h3>Зарплата</h3>
    <div class="b-one__fieldset">
        {{ Form::label('cost_min', 'От', array('class'=>''))    }}
        {{ Form::text('cost_min', 0)    }}
    </div>
    <div class="b-one__fieldset">
        {{ Form::label('cost_max', 'До', array('class'=>''))    }}
        {{ Form::text('cost_max', 0)    }}
    </div>

    {{ Form::submit('Искать', array('class'=>''))    }}

    {{ Form::close();}}


    @if(isset($results))
    <div class="b-results">
        @foreach($results as $work)
        <div class="b-work__title">{{$work->name}}</div>
        @endforeach
    </div>
    @endif

</div>
@endsection