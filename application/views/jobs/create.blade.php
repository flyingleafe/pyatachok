@layout('master')

@section('content')

<div class="main">
    <div class="slogan" style="padding-bottom: 20px;">Создать предложение о работе: </div>

    @if( isset($errors) AND !empty($errors->messages))
    <div class="error-list">
        <h3>Исправьте пожалуйста следующие ошибки: </h3>
        {{ $errors->first('phone',        '<p class="error">:message</p>') }}
        {{ $errors->first('jobtype_id', '  <p class="error">:message</p>') }}
        {{ $errors->first('price',        '<p class="error">:message</p>') }}
        {{ $errors->first('description',  '<p class="error">:message</p>') }}
        {{ $errors->first('place',        '<p class="error">:message</p>') }}
        {{ $errors->first('time_start',   '<p class="error">:message</p>') }}
        {{ $errors->first('time_end',     '<p class="error">:message</p>') }}
        {{ $errors->first('target_count', '<p class="error">:message</p>') }}
    </div>
    @endif


    {{ Form::open('jobs/create', 'POST', array('class' => '')) }}
        <table class="table-red">
            <tr>
                <th colspan="2">
                    Создать работу
                </th>
            </tr>
            <tr>
               <td>Тип работ: </td>
               <td> @include('blocks.jobtypes')</td>
            </tr>

            <tr>
               <td>Ваше имя: </td>
               <td>{{ Form::text('name', $model->name,  array('id'=>'name') )    }} </td>
            </tr>
            <tr>
               <td>Размер оплаты </td>
                <td> {{ Form::text('price', '',  array('id'=>'price') )    }} </td>
            </tr>

            <tr>
               <td>Телефон</td>
                <td> {{ Form::text('phone', $model->phone,   array('id'=>'phone') )    }} </td>
             </tr>

            <tr>
               <td>Описание</td>
                <td> {{ Form::textarea('description', '',  array('id'=>'description') )    }} </td>
            </tr>

            <tr>
               <td>Место проведения</td>
                <td> {{ Form::text('place', '',  array('id'=>'place') )    }} </td>
            </tr>
            <tr>
               <td>Дата начала</td>
                <td> {{ Form::text('time_start', '',  array('id'=>'time_start') )    }} </td>
            </tr>

            <tr>
               <td>Дата окончания</td>
                <td> {{ Form::text('time_end', '',  array('id'=>'time_end') )    }} </td>
            </tr>

            <tr>
               <td>Количество человек</td>
                <td>
                    {{ Form::select('target_count', array(1,2,3,4,5,6,7))    }}
                    <p>Большее количество участников доступно в платном режиме</p>
                </td>
            </tr>
        </table>
        </br>

        {{ Form::submit('Создать', array('class'=>'red-button'))    }}

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