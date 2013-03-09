@layout('master')

@section('content')




<div class="container">
    <div class="b-content">
        <h1>Найти рабочих</h1>

        @if($errors->has())
        {{ $errors->first('name', '<p>:message</p>') }}
        @endif


        {{ Form::open('workers/search', 'POST', array('class' => 'b-form', 'id'=>'search-workers')) }}

        <?  $jobtypes = Jobtype::All();  ?>

        @if($jobtypes)
        <div class="b-one-group">
                <h3>Выберите тип работ:</h3>
                <select id="select_job_types"  name="job_id" class="chzn-select">
                    <option value="">Тип работ</option>
                    <?foreach($jobtypes as $job){?>
                    <option value="{{$job->id}}">{{$job->name}}</option>
                    <?}?>
                </select>

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
            {{ Form::text('rating', '', array('id'=>'rating'))    }}
        </div>

        <div class="b-one-group">
            <h3>Пол</h3>
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
        </div>

        <div class="b-one-group">
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
        </div>


        <div class="b-one-group">
            <h3>Возраст</h3>
            <div id="age_slider"></div>
            <div class="b-one__fieldset">
                {{ Form::label('age_min', 'От', array('class'=>'',))    }}
                {{ Form::text('age_min', '', array( 'id'=>'age_min'))    }}
            </div>
            <div class="b-one__fieldset">
                {{ Form::label('age_max', 'До', array('class'=>''))    }}
                {{ Form::text('age_max', '', array( 'id'=>'age_max'))    }}
            </div>
        </div>


        <div class="b-one-group">
            <h3>Зарплата</h3>
            <div id="cost_slider"></div>
            <div class="b-one__fieldset">
                {{ Form::label('cost_min', 'От', array('class'=>'',))    }}
                {{ Form::text('cost_min', '', array( 'id'=>'cost_min'))    }}
            </div>
            <div class="b-one__fieldset">
                {{ Form::label('cost_max', 'До', array('class'=>''))    }}
                {{ Form::text('cost_max', '', array( 'id'=>'cost_max'))    }}
            </div>
        </div>

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
                $('#reset_filter').on('click', function(){
                    $('#search-workers').each (function(){
                        this.reset();
                    });
                });
                $('#search-workers').on('change' ,function(){
                    var jobtype_id = $('#select_job_types').val();
                    var name = $('#name').val();
                    var created_at = $('#created_at').val();
                    var rating = $('#rating').val();
                    var gender = $('input[name=gender]:checked', this).val();
                    var team = $('#team').val();
                    var age = $('#age').val();

                    var cost_min = $('#cost_min').val();
                    var cost_max = $('#cost_max').val();


                    var age_min = $('#age_min').val();
                    var age_max = $('#age_max').val();

                    $.ajax({
                        // AJAX-specified URL
                        url: "<?=URL::to('workers/search')?>",
                        dataType : "html",
                        type: 'POST',
                        data: {
                            'jobtype_id':jobtype_id,
                            'name':name,
                            'rating':rating,
                            'gender':gender,
                            'created_at':created_at,
                            'team':team,
                            'age':age,
                            'cost_min':cost_min,
                            'cost_max':cost_max,
                            'age_min':age_min,
                            'age_max':age_max
                        },
                        success: function (data) {
                            $('#ajaxResponceSearch').html(data);
                        }
                    });

                }).change();

                $( "#created_at" ).datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true
                });


                $(function() {
                    $("#cost_slider").slider({
                        min: 0,
                        max: 10000,
                        values: [0,10000],
                        range: true,
                        stop: function(event, ui) {
                            jQuery("#cost_min").val(jQuery("#cost_slider").slider("values",0));
                            jQuery("#cost_max").val(jQuery("#cost_slider").slider("values",1));
                        },
                        slide: function(event, ui){
                            jQuery("#cost_min").val(jQuery("#cost_slider").slider("values",0));
                            jQuery("#cost_max").val(jQuery("#cost_slider").slider("values",1));
                        },
                        change: function( event, ui ) {
                            $('#search-workers').change();
                        }
                    });

                    $("#age_slider").slider({
                        min: 18,
                        max: 100,
                        values: [18,100],
                        range: true,
                        stop: function(event, ui) {
                            jQuery("#age_min").val(jQuery("#age_slider").slider("values",0));
                            jQuery("#age_max").val(jQuery("#age_slider").slider("values",1));
                        },
                        slide: function(event, ui){
                            jQuery("#age_min").val(jQuery("#age_slider").slider("values",0));
                            jQuery("#age_max").val(jQuery("#age_slider").slider("values",1));
                        },
                        change: function( event, ui ) {
                            $('#search-workers').change();
                        }
                    });

                });
            });
        </script>

        <input type="button" value="Сбросить фильтр" id="reset_filter">
        <div id="ajaxResponceSearch"></div>
    </div>
</div>
@endsection