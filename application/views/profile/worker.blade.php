@layout('master')

@section('content')

<div class="b-user-info">
    <h1>Личный кабинет</h1>
    <div class="b-one__fieldset">
        <label>Номер телефона:</label>
        {{ Auth::user()->phone;}}
    </div>

    <div class="b-one__fieldset">
        <label>Имя и фамилия:</label>
        {{ Auth::user()->name_and_surname;}}
    </div>


    <?
        $jobtypes = Jobtype::All();
    ?>

    {{ Form::open('profile/update', 'POST', array('class' => '')) }}
    <select id="select_job_types" class="chzn-select" multiple>
        @foreach($jobtypes as $job)
            <option value="{{$job->id}}">{{$job->name}}</option>
        @endforeach;
    </select>
    <input id="add_job_types" type="button" value="Добавить">
    <div class="b-selected-job">
    </div>


    {{ Form::submit('Отправить', array('class'=>''))    }}
    {{ Form::close();}}
</div>

    <script type="text/javascript">
        $(function (){

            var user_jobtypes;
            $("#select_job_types").chosen({
                no_results_text: "Ничего не найдено",
                placeholder_text: 'Выберите типы работ'
            });

            $('#add_job_types').click( function (){
                var selected_job_types =  $('#select_job_types').val();

                var quantity_selected = selected_job_types.length;

                for(i= 0; i<quantity_selected; i++){

                    var job_name = $('#select_job_types  option[value='+selected_job_types[i]+']').text()

                    var job =
                          '<p>Cтоимость: '
                           +job_name+ '<input type="text" value="'
                           +selected_job_types[i]+'" name="job_ids[]" />' +'</p>'
                           +'<input type="text" name="cost[]" value="0"/>';

                    $('.b-selected-job').append(job);
                }
            });
            $('').submit(function(){

                $('#job_types').val(user_jobtypes)
            });
        });

    </script>
<a href="/">Назад</a>
@endsection