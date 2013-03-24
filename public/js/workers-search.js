/**
 * Класс Employer - управляет выбранными рабочими
 * @param {string} url       Адрес REST-интерфейса для выбранных рабочих
 * @param {[type]} container [description]
 * @param {[type]} template  [description]
 */
function Employer(url, container, template) {
    var self = this;
    self.data = null;
    self.url = url;
    self.container = container;
    self.template = Handlebars.compile(template.html());
}

Employer.prototype.update = function(callback) {
    var self = this;
    $.getJSON(self.url, function(data) {
        console.log(data);
        self.data = data;
        if(callback)
            callback();
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
    WorkerEmployer.update(function() {
        WorkersResult.fetch();
    });

    Handlebars.registerHelper('if_chosen', function(id, options) {
        if($.inArray(id.toString(), WorkerEmployer.data.ids) > -1) {
            return options.fn(this);
        }
    });

    $( "#created_at" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        changeYear: true
    });

    //Слайдер для выбора возраста
    var min_age = 14;
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

    $('body').on('change', '.worker_choose input', function() {
        if(this.checked) {
            WorkerEmployer.choose($(this).val());
        } else {
            WorkerEmployer.remove($(this).val());
        }
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