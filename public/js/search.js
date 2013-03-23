/**
 * Класс Result - контролирует получение и отображение списков данных с сервера
 * @param {Object} data      Полученные данные
 * @param {String} url       AJAX-адрес
 * @param {jQuery.fn} form      Форма поиска и фильтрации
 * @param {jQuery.fn} container Контейнер для результатов
 * @param {jQuery.fn} template  script-элемент, задающий шаблон Handlebars
 * @param {jQuery.fn} paginator Контейнер для пагинации
 */
function Result(data, url, form, container, template, paginator) {
    var self = this;
    self.fetch_url = url;
    self.form = form.on('change', function() { self.fetch.call(self) });
    self.container = container;
    self.template = Handlebars.compile(template.html());
    self.data = data;

    self.pg_settings = {
        prevText: 'Назад',
        nextText: 'Вперед',
        cssStyle: 'light-theme',
        onPageClick: function(num, e) {
            self.fetch();
        }
    };
    self.paginator = paginator.pagination(self.pg_settings);

    self.sort_criteria = 'created_at';
    self.sort_order = 'asc';
    self.has_jobtype = false;
    self.form.change();
}

Result.prototype.display = function() {
    this.paginator.pagination($.extend({
        items: this.data.total,
        itemsOnPage: this.data.per_page,
        currentPage: this.data.page
    }, this.pg_settings));
    this.container.html(this.template(this.data));
};

Result.prototype.setData = function(data) {
    this.data = data;
    this.data.has_jobtype = this.has_jobtype;
    this.display();
};

Result.prototype.fetch = function() {
    var self = this,
        page_num = self.paginator.pagination('getCurrentPage');
    $.ajax({
        // AJAX-specified URL
        url: URLS.workers_search,
        dataType : "json",
        type: 'POST',
        data: self.form.serialize() + '&page=' + page_num + '&sort_criteria=' + self.sort_criteria + '&sort_order=' + self.sort_order,
        success: function (data) {
            self.setData(data);
        }
    });
    page_num = page_num || 1;
};

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

$(function() {

    $("#select_job_types").chosen({
        no_results_text: "Ничего не найдено",
        placeholder_text: 'Выберите типы работ',
        allow_single_deselect: true
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

    var min_age = 14,
        max_age = 100;
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

        // search_workers_form.change();//submit form
        search_jobs_form.change();//submit form
    });
});