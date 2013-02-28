@layout('admin')

@section('content')
    <h3>Список пользователей</h3>
    <div class="tabbable" >
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab">Работники</a></li>
            <li class=""><a href="#tab2" data-toggle="tab">Работодатели</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab1">
                <? $users = DB::table('users')->where('is_worker', '=', 1)->get();?>
                @if(!empty($users))
                <table class="table table-bordered">
                    <tr>
                        <th>Телефон</th>
                        <th>Фамилия и Имя</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>

                    <? $users = DB::table('users')->where('is_worker', '=', true)->get();?>

                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->status}}</td>
                        <td><a href="{{URL::to('admin/users/edit')}}/{{$user->id}}"?><ins class=" icon-edit"></ins> </a></td>
                    </tr>
                    @endforeach
                </table>
                @else
                <p class='alert alert-info'>Нет записей</p>
                @endif
            </div>
            <div class="tab-pane" id="tab2">
                <? $employers = DB::table('users')->where('is_worker', '=', 0)->get();?>
                @if(!empty($employers))
                <table class="table table-bordered">
                    <tr>
                        <th>Телефон</th>
                        <th>Фамилия и Имя</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>


                    @foreach($employers as $employer)
                    <tr>
                        <td>{{$employer->phone}}</td>
                        <td>{{$employer->name}}</td>
                        <td>{{$employer->status}}</td>
                        <td><a href="{{URL::to('admin/users/edit')}}/{{$user->id}}"?><ins class=" icon-edit"></ins> </a></td>
                    </tr>
                    @endforeach

                </table>
                @else
                <p class='alert alert-info'>Нет записей</p>
                @endif
            </div>

        </div>
    </div>

    <p>Всего пользователей: {{ count(User::all()) }}</p>
    <p>Зарегистрировано сегодня: <?  count(DB::table('users')->where('created_at', '>=', '')); ?></p>
@endsection
