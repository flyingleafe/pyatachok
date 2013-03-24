/**
 * Класс Employer - управляет выбранными рабочими
 * @param {string} url       Адрес REST-интерфейса для выбранных рабочих
 * @param {jQuery.fn} container Контейнер для результатов
 * @param {jQuery.fn} template  Контейнер для Handlebars-шаблона
 * @param {Result} result_handler Управление результатами рабочих
 */
function Employer(url, container, template, result_handler) {
    var self = this;
    self.data = null;
    self.url = url;
    self.container = container;
    self.template = Handlebars.compile(template.html());
    self.rhandler = result_handler;
}

Employer.prototype.display = function() {
    this.container.html(this.template(this.data));
};

Employer.prototype.update = function(fetch) {
    var self = this;
    $.getJSON(self.url, function(data) {
        console.log(data);
        self.data = data;
        self.display();
        if(fetch)
            self.rhandler.fetch();
        else
            self.rhandler.display();
    });
};

Employer.prototype.choose = function(id) {
    var self = this;
    $.post(self.url + '/' + id, function(data) {
        console.log(data);
        self.update();
    }, 'json');
};

Employer.prototype.remove = function(id) {
    var self = this;
    $.post(self.url + '/' + id, { _method: 'DELETE' }, function(data) {
        console.log(data);
        self.update();
    }, 'json');
};

Employer.prototype.hasChosen = function(id) {
    return $.inArray(id.toString(), this.data.ids) > -1;
};

$(function() {
    var WorkerEmployer = new Employer(
            URLS.workers_chosen,
            $("#chosenWorkersContainer"),
            $("#chosen-template")
        ),
        WorkersResult = new Result(
            null,
            URLS.workers_search,
            $('#search-workers'),
            $("#ajaxResponseSearch"),
            $("#result-template"),
            $(".workers-pagination")
        );
    // fLf: соединяем Employer и Result в священный симбиоз
    WorkerEmployer.rhandler = WorkersResult;
    WorkerEmployer.update(true);

    Handlebars.registerHelper('if_chosen', function(id, options) {
        if(WorkerEmployer.hasChosen(id)) {
            return options.fn(this);
        }
    });

    $( "#created_at" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        changeYear: true
    });

    //Слайдер для выбора возраста
    var min_age = 14,
        max_age = 100;

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

    $('body').on('click', '.worker_choose input', function(e) {
        e.preventDefault();
        var id = $(this).val();
        if( ! this.checked ) {
            if( WorkerEmployer.hasChosen(id) )
                WorkerEmployer.remove(id);
        } else {
            if( ! WorkerEmployer.hasChosen(id) )
                WorkerEmployer.choose(id);
        }
    }).on('click', '.chosen_remove a', function(e) {
        e.preventDefault();
        WorkerEmployer.remove($(this).data('id'));
    });

    WorkersResult.form.on('change' ,function(){
        var jobtype_id = $('#select_job_types').val();
        if(jobtype_id.length != 0 ){
            $( "#cost_slider" ).slider( "enable" );
            WorkersResult.has_jobtype = true;
        } else {
            WorkersResult.has_jobtype = false;
        }
    });
});