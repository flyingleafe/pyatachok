$(function() {
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
        yearSuffix: ''
    };

    $.datepicker.setDefaults($.datepicker.regional['ru']);

    $("#select_job_types").chosen({
        no_results_text: "Ничего не найдено",
        placeholder_text: 'Выберите типы работ'
    });

    $( "#created_at" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        changeYear: true
    });

    //Слайдер для выбора зарплаты
    var min_cost = 0;
    var max_cost = 10000;
    $("#cost_slider").slider({
        min: min_cost,
        max: max_cost,
        values: [min_cost,max_cost],
        range: true,
        stop: function(event, ui) {
            $("#cost_min").val($("#cost_slider").slider("values",0));
            $("#cost_max").val($("#cost_slider").slider("values",1));
        },
        slide: function(event, ui){
            $("#cost_min").val($("#cost_slider").slider("values",0));
            $("#cost_max").val($("#cost_slider").slider("values",1));
        },
        change: function( event, ui ) {
            $('#search-workers').change();
        }
    });
    $( "#cost_slider" ).slider( "disable" ); //заблокируем выбор диапазона зарплат, пока не выбран тип работ

    //Слайдер для выбора возраста
    var min_age = 18;
    var max_age = 100;

    $("#age_slider").slider({
        min: min_age,
        max: max_age,
        values: [min_age,max_age],
        range: true,
        stop: function(event, ui) {
            $("#age_min").val($("#age_slider").slider("values",0));
            $("#age_max").val($("#age_slider").slider("values",1));
        },
        slide: function(event, ui){
            $("#age_min").val($("#age_slider").slider("values",0));
            $("#age_max").val($("#age_slider").slider("values",1));
        },
        change: function( event, ui ) {
            $('#search-workers').change();
        }
    });

    //ajax-поиск рабочих
    $('#search-workers').on('change' ,function(){
        var jobtype_id = $('#select_job_types').val();
        if(jobtype_id.length != 0 ){
            $( "#cost_slider" ).slider( "enable" );
        }
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
            url: URLS.workers_search,
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

    //Cброс фильтрации
    $('#reset_filter').on('click', function(){
        var search_workers_form = $('#search-workers');

        search_workers_form.each (function(){
            this.reset();
        });
        //reset slider position
        $('#age_slider').slider("values", 0, min_age);
        $('#age_slider').slider("values", 1, max_age);

        $('#cost_slider').slider("values", 0, min_cost);
        $('#cost_slider').slider("values", 1, max_cost);

        $( "#cost_slider" ).slider( "disable" );
        $("#select_job_types").val('').trigger("liszt:updated");
        search_workers_form.change();//submit form
    });
});