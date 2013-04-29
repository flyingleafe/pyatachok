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
            console.log(126);
            if($('#jobtype_'+ids_array[i]).length == 0) {

                var job_name = $('#select_job_types  option[value='+ids_array[i]+']').text();

                var job_type = $('<input>')
                        .attr('value', ids_array[i])
                        .attr('name', 'job_ids[]' )

                        .attr('type', 'hidden');

                var cost = $('<input>')
                        .attr('name', 'cost[]')
                        .attr('type', 'text')
                        .attr('class', 'cost-input')
                        .attr('value', 1)

                var label_td = $('<td></td>');
                var cost_td = $('<td></td>');
                var ru = $('<ins>').text('руб. / час');


                var job = $('<tr></tr>')
                        .attr('id', 'jobtype_'+ids_array[i])
                        .append(label_td.append(job_name))
                        .append(cost_td.append(cost))
                        .append(cost_td.append(ru))
                        .append(job_type);

                console.log(job);


                $('.b-selected-job').append(job);
            }
        }
    });
});