@layout('admin')

@section('content')
    <h3>Список типов работ</h3>
    <table class="table table-bordered">
        <tr>
            <th>Название</th>
            <th>Количество</th>
            <th>Редактировать</th>
        </tr>
        <? $jobtypes = Jobtype::all()?>
        @foreach ($jobtypes as $job)
            <tr>
                <td>{{$job->name}}</td>
                <td>4</td>
                <td><a href=" {{ URL::to('admin/works/edit/').$job->id }}"><ins class="icon icon-edit"></ins></a> </td>
            </tr>
        @endforeach

    </table>
    <a class="btn btn-info" href="{{URL::to('admin/works/add') }}">Добавить</a>
@endsection