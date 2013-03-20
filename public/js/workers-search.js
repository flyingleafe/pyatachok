$(function() {


    $( "#created_at" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        changeYear: true
    });


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
});