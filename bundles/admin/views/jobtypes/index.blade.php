@layout('admin::master')

@section('content')
    <h3>Список типов работ</h3>
    <table class="table table-bordered">
        <tr>
            <th>Название</th>
            <th>Кол-во рабочих</th>
            <th>Редактировать</th>
        </tr>
        @foreach (Jobtype::all() as $jobtype)
            <tr>
                <td>{{ $jobtype->name }}</td>
                <td>{{ $jobtype->users()->count() }}</td>
                <td><a href=" {{ URL::to('admin/jobtypes/edit/'.$jobtype->id) }}"><ins class="icon icon-edit"></ins></a> </td>
            </tr>
        @endforeach

    </table>
    <a class="btn btn-info" href="{{ URL::to('admin/jobtypes/add') }}">Добавить</a>
@endsection