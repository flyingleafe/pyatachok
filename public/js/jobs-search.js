$(function() {

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

    $('#search-jobs').on('change' ,function(){
        var jobtype_id = $('#select_job_types').val();
        if(jobtype_id.length != 0 ){
            $( "#cost_slider" ).slider( "enable" );
        }
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();


        var cost_min = $('#cost_min').val();
        var cost_max = $('#cost_max').val();


        $.ajax({
            url: URLS.jobs_search,
            dataType : "html",
            type: 'POST',
            data: {
                'jobtype_id':jobtype_id,
                'cost_min':cost_min,
                'cost_max':cost_max,
                'start_date':start_date,
                'end_date':end_date
            },
            success: function (data) {
                $('#ajaxResponceSearch').html(data);
            }
        });

    }).change();

});