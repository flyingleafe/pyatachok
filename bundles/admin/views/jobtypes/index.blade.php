@layout('admin::master')

@section('before_assets')
<script>
    var URLS = {
        jobstype_search : "{{ URL::to('admin/jobtypes/search') }}"
    }
</script>
@endsection

@section('content')
    <h3>Список типов работ</h3>

    <div class="b-filter">
        <h4> Фильтрация</h4>

        <div class="row">
            <div class="span3">
                <label>Тип работ</label>
                <input type="text" name="jobtype_id" id="jobtype_id">
            </div>
        </div>

        <input type="submit" class="btn btn-primary" id="ajaxSearchJobtypes" value="Искать">
    </div>
    </br>
    <table class="table table-bordered">
        <tr>
            <th>Название</th>
            <!--th>Кол-во рабочих</th-->
            <th>Редактировать</th>
        </tr>
        <?php $jobtypes = DB::table('jobtypes')->paginate(10); ?>
        <tbody class="ajaxUpdate">
            @foreach ($jobtypes->results as $jobtype)
                <tr>
                    <td>{{ $jobtype->name }}</td>

                    <td><a href=" {{ URL::to('admin/jobtypes/edit/'.$jobtype->id) }}"><ins class="icon icon-edit"></ins></a> </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        $(function(){
            $('#ajaxSearchJobtypes').on('click', function(){
                var val = $('#jobtype_id').val();
                $.ajax({
                    url: URLS.jobstype_search,
                    type: 'POST',
                    data: {jobtype_name: val },
                    success : function(data){
                        $('.ajaxUpdate').html(data);
                    }
                });
            });
        });
    </script>
    <?php echo $jobtypes->links(); ?>
    <a class="btn btn-info" href="{{ URL::to('admin/jobtypes/add') }}">Добавить</a>
@endsection