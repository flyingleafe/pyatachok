$(function() {

    Jobs = new Result(
        null,
        URLS.jobs_search,
        $('#search-jobs'),
        $("#ajaxResponseSearch"),
        $("#result-template"),
        $(".jobs-pagination")
    );
    Jobs.fetch();

    $('#start_date').datetimepicker({
        dateFormat: "dd-MM-yy",
        timeFormat: "HH:mm",
        numberOfMonths: 3,
        onClose: function( selectedDate ) {
            $( "#end_date" ).datepicker( "option", "minDate", selectedDate );
        }
    });

    $('#end_date').datetimepicker({
        dateFormat: "dd-MM-yy",
        timeFormat: "HH:mm",
        onClose: function( selectedDate ) {
            $( "#start_date" ).datepicker( "option", "maxDate", selectedDate );
        }
    });

    Jobs.form.on('change' ,function(){
        var jobtype_id = $('#select_job_types').val();
        if(jobtype_id.length != 0 ){
            $( "#cost_slider" ).slider( "enable" );
            Jobs.has_jobtype = true;
        } else {
            Jobs.has_jobtype = false;
        }
    });

});