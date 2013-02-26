@layout('master')

@section('content')



<a href="/">Назад</a>
<div class="b-user-info">
    <h1>Личный кабинет</h1>
    <div class="b-one__fieldset">
        <label>Номер телефона:</label>
        <span>{{ Auth::user()->phone;}}</span>
    </div>

    <div class="b-one__fieldset">
        <label>Имя и фамилия:</label>
        <span>{{ Auth::user()->name_and_surname;}}</span>
    </div>

    <?  $jobtypes = Jobtype::All();  ?>

    {{ Form::open('profile/update', 'POST', array('class' => '')) }}
    @if($jobtypes)
        <div class="b-jobtypes_inner">
            <h3>Выберите типы работ:</h3>

            <select id="select_job_types" class="chzn-select" multiple>
                <?foreach($jobtypes as $job){?>
                    <option <? if(array_key_exists($job->id, $user_jobtypes)) echo 'selected'?> value="{{$job->id}}">{{$job->name}}</option>
                <?}?>
            </select>
        </div>
    @endif


    <input id="add_job_types" type="button" value="Добавить" style="float: left">
    <div class="clear"></div>
    <div class="b-selected-job">
        <div class="b-user-job">
            <span class="b-jobtype__label">Тип работ:</span>
            <span class="b-jobcost__label">Стоимость</span>
            <div class="clear"></div>
        </div>
        <?foreach ($user_jobtypes as $user_job=>$const){?>



        <div class="b-user-job" id="jobtype_{{$user_job}}">
             <span class="b-jobtype__label"><?echo Jobtype::find($user_job)->name ?></span>
             <span class="b-jobcost__label"><input type="text" name="cost[]" value="{{$const}}"> <ins>руб</ins></span>
             <input type="hidden"  name="job_ids[]" value="{{$user_job}}">
             <div class="clear"></div>
        </div>

        <?}?>
    </div>


    {{ Form::submit('Сохранить', array('class'=>''))    }}
    {{ Form::close();}}
</div>

    <script type="text/javascript">
        $(function (){
            $("#select_job_types").chosen({
                no_results_text: "Ничего не найдено",
                placeholder_text: 'Выберите типы работ',
                eval_function: function(){
                    $.ajax({
                        url: '<?=URL::to("profile/delete_job") ?>',
                        type: 'GET',
                        dataType: 'json',
                        cache: false,
                        data: {'id':id }
                    });
                    $('#jobtype_'+id).remove();
                }

            });

            $("#select_job_types").trigger('liszt:updated');

            $('#add_job_types').click( function (){
                var ids_array =  $('#select_job_types').val();

                var q_ids = ids_array.length;

                for(i= 0; i<q_ids; i++){

                    if($('#jobtype_'+ids_array[i]).length == 0){
                        var job_name = $('#select_job_types  option[value='+ids_array[i]+']').text();

                        var job_type = $('<input>')
                                .attr('value', ids_array[i])
                                .attr('name', 'job_ids[]' )

                                .attr('type', 'hidden');

                        var cost = $('<input>')
                                .attr('name', 'cost[]')
                                .attr('type', 'text')
                                .attr('value', 1)

                        var jtl = $('<span>').attr('class', 'b-jobtype__label');
                        var jcl = $('<span>').attr('class', 'b-jobcost__label');
                        var ru = $('<ins>').text('руб.');
                        var clear = $('<div>').attr('class', 'clear');

                        var job = $('<div>')
                                .attr('class', 'b-user-job')
                                .attr('id', 'jobtype_'+ids_array[i])
                                .append(jtl.append(job_name))
                                .append(jcl.append(cost))
                                .append(jcl.append(ru))
                                .append(job_type)
                                .append(clear);



                        $('.b-selected-job').append(job);
                    }

                }
            });

        });

    </script>

@endsection