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
            $('#search-workers, #search-jobs').change();
        }
    });
    $( "#cost_slider" ).slider( "disable" ); //заблокируем выбор диапазона зарплат, пока не выбран тип работ



    //Cброс фильтрации
    $('#reset_filter').on('click', function(){
        var search_workers_form = $('#search-workers');
        var search_jobs_form = $('#search-jobs');

        search_workers_form.each (function(){
            this.reset();
        });
        search_jobs_form.each (function(){
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
        search_jobs_form.change();//submit form
    });
});