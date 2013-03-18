@layout('admin::master')

@section('before_assets')
@endsection

@section('content')
    <h3>Список  работ</h3>
    <div class="b-filter">
        <h4> Фильтрация</h4>

        <div class="row">
            <div class="span3">
                <label>Тип работ</label>
                <input type="text" name="jobtype_id">
            </div>

            <div class="span3">
                <label>Имя работадателя</label>
                <input name="name" type="text"/>
            </div>
        </div>

        <div class="row">
            <div class="span3">
                <label>Статус работ</label>
                <select type="text" name="job_status">
                    <option value="">Любой</option>
                    <option value="">Открытая</option>
                    <option value="">Закрытая</option>
                </select>
            </div>

            <div class="span3">
                <label>Описание</label>
                <input type="text" name="description">
            </div>
        </div>

        <div class="row">
            <div class="span3">
                <label>Телефон</label>
                <input type="text" name="phone">
            </div>

            <div class="span3">
                <label>Количество участников</label>
                <input type="text" name="target_count">
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Искать">
    </div>

    </br>
    </br>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Тип работы</th>
            <th>Работадатель</th>
            <th>Описание</th>
        </tr>
        <?php $jobs = DB::table('jobs')->paginate(10); ?>

        @foreach ($jobs->results as $job)
            <tr>
                <td>{{ $job->id }}</td>
                <td> {{Jobtype::find($job->jobtype_id)->name}} </td>
                <td>{{ $job->name }}</td>
                <td>{{ $job->description }}</td>

                <td><a href="{{ URL::to('admin/jobs/edit/'.$job->id) }}"><ins class="icon icon-edit"></ins></a> </td>
                <td><a href="{{ URL::to('admin/jobs/view/'.$job->id) }}"><ins class="icon icon-eye-open"></ins></a> </td>
                <td><a href="{{ URL::to('admin/jobs/delete/'.$job->id) }}" data-confirm="Вы действительно хотите удалить выбранную работу?"  class="delete_job"><ins class="icon icon-remove"></ins></a> </td>
            </tr>
        @endforeach

    </table>
    <?php echo $jobs->links(); ?>
    <a class="btn btn-info" href="{{ URL::to('admin/jobtypes/add') }}">Добавить</a>
    </br>
    </br>
<script>
    $(function() {
        $('a[data-confirm].delete_job').click(function(ev) {
            var href = $(this).attr('href');
            var tr = $(this).parent().parent();
            if (!$('#dataConfirmModal').length) {
                $('body').append('' +
                    '<div id="dataConfirmModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true">' +
                    '<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>' +
                    '<h3 id="dataConfirmLabel">Пожалуйста подтвердите</h3></div><div class="modal-body"></div><div class="modal-footer">' +
                    '<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>' +
                    '<a class="btn btn-primary" id="dataConfirmOK">OK</a></div></div>'
                );
            }
            $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
            $('#dataConfirmOK').click( function(){

                $.ajax({
                    url: href,
                    type: 'GET',
                    success : function(){
                        tr.remove();
                    }
                });
                $('#dataConfirmModal .close').click();
                return false;
            });
            $('#dataConfirmModal').modal({show:true});
            return false;
        });
    });
</script>
@endsection