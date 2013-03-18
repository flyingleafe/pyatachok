@layout('admin::master')

@section('content')
<a class="btn btn-primary" href="{{ URL::to('admin/jobs') }}">Вернуться</a>

<h3>Список  работ</h3>

<table class="table table-bordered">
    <tr>
        <th>Поле: </th>
        <th>Значение: </th>
    </tr>

    <tr>
        <th>ID</th>
        <th>{{$model->id}}</th>
    </tr>

    <tr>
        <th>Имя работадателя: </th>
        <th>{{ Jobtype::find($model->jobtype_id)->name}}</th>
    </tr>

    <tr>
        <th>Имя работадателя: </th>
        <th>{{$model->name}}</th>
    </tr>

    <tr>
        <th>Телефон: </th>
        <th>{{$model->phone}}</th>
    </tr>

    <tr>
        <th>Тип работы: </th>
        <?php $type = array('0'=>'Закрытая', '1'=>'Открытая')?>
        <th>{{ $type[ (int) $model->type] }}</th>
    </tr>

    <tr>
        <th>Описание: </th>
        <th>{{$model->description }}</th>
    </tr>

    <tr>
        <th>Цена работ: </th>
        <th>{{$model->price }}</th>
    </tr>

    <tr>
        <th>Участники: </th>
        <th></th>
    </tr>

    <tr>
        <th>Количество участников: </th>
        <th>{{$model->target_count}}</th>
    </tr>

</table>

@endsection