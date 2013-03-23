$(function() {

    var WorkersResult = new Result(
            null,
            URLS.workers_search,
            $('#search-workers'),
            $("#ajaxResponseSearch"),
            $("#result-template"),
            $("#workers-pagination")
        );

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