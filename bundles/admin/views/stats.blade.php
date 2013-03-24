@layout('admin::master')

@section('content')

<h3>Страница статистики</h3>

<div class="span8">

        <table class="table table-bordered">
            <tr>
                <td>Количество пользователей</td>
                <td>{{DB::table('users')->count();}}</td>
            </tr>

            <tr>
                <td>Количество рабочих</td>
                <td>{{DB::table('users')->where('is_worker', '=', true)->count();}}</td>
            </tr>

            <tr>
                <td>Количество работадателей</td>
                <td>{{DB::table('users')->where('is_worker', '=', 0)->count();}}</td>
             </tr>

        </table>

        <h4>Работы</h4>
        <table class="table table-bordered">
            <tr>
                <td>Количество работ</td>
                <td>{{DB::table('jobs')->count();}}</td>
            </tr>

            <tr>
                <td>Открытых</td>
                <td>{{DB::table('jobs')->where('status', '=', 1)->count();}}</td>
            </tr>

            <tr>
                <td>Закрытых</td>
                <td>{{DB::table('jobs')->where('status', '=', 0)->count();}}</td>
            </tr>

        </table>

        <h4>СМС рассылка</h4>
        <table class="table table-bordered">
            <tr>
                <td>Отослано смс всего: </td>
                <td>10</td>
            </tr>

            <tr>
                <td>На подтверждение и смену телефона: </td>
                <td>10</td>
            </tr>

            <tr>
                <td>Приглашений на работу: </td>
                <td>10</td>
            </tr>

            <tr>
                <td>Уведомлений о новых работах: </td>
                <td>10</td>
            </tr>

        </table>

</div>

@endsection