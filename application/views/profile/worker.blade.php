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

    <? print_r($user_jobtypes);?>
    <?  $jobtypes = Jobtype::All();  ?>

    {{ Form::open('profile/update', 'POST', array('class' => '')) }}
    <select id="select_job_types" class="chzn-select" multiple>
        <?foreach($jobtypes as $job){?>
            <option <? if(array_key_exists($job->id, $user_jobtypes)) echo 'selected'?> value="{{$job->id}}">{{$job->name}}</option>
        <?}?>endforeach;
    </select>

    <input id="add_job_types" type="button" value="Добавить">
    <div class="b-selected-job">
        <?foreach ($user_jobtypes as $user_job=>$const){?>

        <div class="b-user-job">
            <label>Тип работ</label>
            <?echo 'drere'?>
            <label>Стоимость</label>
            <input type="text" name="job_ids[]" value="{{$user_job}}">

            <input type="text" name="cost[]" value="{{$const}}">
        </div>

        <?}?>
    </div>


    {{ Form::submit('Отправить', array('class'=>''))    }}
    {{ Form::close();}}
</div>

    <script type="text/javascript">
        $(function (){
            $("#select_job_types").chosen({
                no_results_text: "Ничего не найдено",
                placeholder_text: 'Выберите типы работ',
                eval_function: function(){
                    $.ajax({
                        url: "<?=URL::to("profile/delete_job") ?>",
                        type: 'GET',
                        dataType: "json",
                        cache: false,
                        data: {"id":id }
                    });
                }

            });



            $("#select_job_types").trigger('liszt:updated');

            $('#add_job_types').click( function (){
                var ids_array =  $('#select_job_types').val();

                var q_ids = ids_array.length;

                for(i= 0; i<q_ids; i++){

                    var job_name = $('#select_job_types  option[value='+ids_array[i]+']').text()

                    var job =
                      '<div class="b-user-job">'+
                          '<label>'+job_name+'</label>'
                           +'Cтоимость:'
                           +'<input type="text" name="cost[]" value="0"/>'
                           +'<input type="hidden" value="'+ids_array[i]+'" name="job_ids[]" />'
                       +'</div>';

                    $('.b-selected-job').append(job);
                }
            });

        });

    </script>
<a href="/">Назад</a>
@endsection