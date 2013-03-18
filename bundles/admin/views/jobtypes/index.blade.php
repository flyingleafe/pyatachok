@layout('admin::master')

@section('content')
    <h3>Список типов работ</h3>

    <div class="b-filter">
        <h4> Фильтрация</h4>

        <div class="row">
            <div class="span3">
                <label>Тип работ</label>
                <input type="text" name="jobtype_id">
            </div>
        </div>

        <input type="submit" class="btn btn-primary" value="Искать">
    </div>
    </br>
    <table class="table table-bordered">
        <tr>
            <th>Название</th>
            <!--th>Кол-во рабочих</th-->
            <th>Редактировать</th>
        </tr>
        <?php $jobtypes = DB::table('jobtypes')->paginate(10); ?>
        @foreach ($jobtypes->results as $jobtype)
            <tr>
                <td>{{ $jobtype->name }}</td>

                <td><a href=" {{ URL::to('admin/jobtypes/edit/'.$jobtype->id) }}"><ins class="icon icon-edit"></ins></a> </td>
            </tr>
        @endforeach
    </table>

    <?php echo $jobtypes->links(); ?>
    <a class="btn btn-info" href="{{ URL::to('admin/jobtypes/add') }}">Добавить</a>
@endsection