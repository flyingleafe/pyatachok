$(function () {
    $("#select_job_types").chosen({
        no_results_text: "Ничего не найдено",
        placeholder_text: 'Выберите типы работ',
        eval_function: function(){
            $.post(
                URLS.job_delete,
                {'id':id },
                'json'
            );
            $('#jobtype_'+id).remove();
        }
    });

    $("#select_job_types").trigger('liszt:updated');

    $('#add_job_types').click( function (){
        var ids_array =  $('#select_job_types').val();

        var q_ids = ids_array.length;

        for(i= 0; i<q_ids; i++) {

            if($('#jobtype_'+ids_array[i]).length == 0) {
                var job_name = $('#select_job_types  option[value='+ids_array[i]+']').text();

                var job_type = $('<input>')
                        .attr('value', ids_array[i])
                        .attr('name', 'job_ids[]' )

                        .attr('type', 'hidden');

                var cost = $('<input>')
                        .attr('name', 'cost[]')
                        .attr('type', 'text')
                        .attr('value', 1)

                var jtl = $('<span>').attr('class', 'b-jobtype__label');
                var jcl = $('<span>').attr('class', 'b-jobcost__label');
                var ru = $('<ins>').text('руб.');
                var clear = $('<div>').attr('class', 'clear');

                var job = $('<div>')
                        .attr('class', 'b-user-job')
                        .attr('id', 'jobtype_'+ids_array[i])
                        .append(jtl.append(job_name))
                        .append(jcl.append(cost))
                        .append(jcl.append(ru))
                        .append(job_type)
                        .append(clear);

                $('.b-selected-job').append(job);
            }
        }
    });
});