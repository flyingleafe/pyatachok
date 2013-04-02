@layout('master')

@section('content')

@include('blocks.header')

<a href="{{ URL::to('jobs') }}">Вернуться назад</a>
<div class="job-cart">
    <table>
        <tr>
            <td>Телефон</td>
            <td>{{$job->phone}}</td>
        </tr>
        <tr>
            <td>Имя работадателя</td>
            <td>{{$job->name}}</td>
        </tr>
        <tr>
            <td>Описание</td>
            <td>{{$job->description}}</td>
        </tr>
        <tr>
            <td>Дата начала</td>
            <td>{{$job->time_start}}</td>
        </tr>
        <tr>
            <td>Дата окончания</td>
            <td>{{$job->time_end}}</td>
        </tr>
        <tr>
            <td>Место проведения </td>
            <td>{{$job->place}}</td>
        </tr>
        <tr>
            <td>Стоимость</td>
            <td>{{$job->price}}</td>
        </tr>
        <tr>
            <td>Количество участгников</td>
            <td>{{$job->targe_count}}</td>
        </tr>
        <tr>
            <td>Тип работ</td>
            <td>{{ Jobtype::find($job->jobtype_id)->name}}</td>
        </tr>
    </table>
</div>

@endsection