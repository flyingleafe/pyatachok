@layout('admin::master')

@section('content')
    <h3>Список пользователей</h3>

        <div class="b-filter">
            {{ Form::open('admin/users', 'POST'); }}
                <h4> Фильтрация</h4>

                <div class="row">
                    <div class="span3">
                        <label>Тип работ</label>
                        <input type="text" name="jobtype_id">
                    </div>

                    <div class="span3">
                        <label>Имя рабочего</label>
                        <input name="name" type="text"/>
                    </div>
                </div>

                <div class="row">
                    <div class="span3">
                        <label>Статус аккаунта</label>
                        {{Form::select('stats_type', User::$stats_type); }}
                    </div>

                    <div class="span3">
                        <label>Тип аккаунта</label>
                        {{Form::select('job_status', User::$acc_type); }}
                    </div>
                </div>

                <div class="row">
                    <div class="span3">
                        <label>Телефон</label>
                        <input type="text" name="phone">
                    </div>

                    <div class="span3">
                        <label>Пол</label>
                        {{Form::select('gender', User::$gender); }}
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Искать">
            {{ Form::close();}}
        </div>

        </br>
        </br>

        <table class="table table-bordered">
            <tr>
                <th>Телефон</th>
                <th>Фамилия и Имя</th>
                <th>Статус</th>
                <th>Пол</th>
                <th>Тип аккаунта</th>
                <th>Действия</th>
            </tr>
        <?php $users = DB::table('users')->paginate(10); ?>
            @foreach($users->results as $user)
            <tr>
                <td>{{$user->phone}}</td>
                <td>{{$user->name}}</td>
                <td>{{ User::$stats_type[$user->status] }}</td>
                <td>
                    <?php $sex = array('0'=>'Женский', '1'=>'Мужской')?>
                    {{$sex[$user->gender] }}
                </td>
                <td>
                    <?php $account = array('0'=>'Работадатель', '1'=>'Рабочий')?>
                    {{ $account[$user->is_worker] }}
                </td>
                <td><a href="{{URL::to('admin/users/edit')}}/{{$user->id}}"?><ins class=" icon-edit"></ins> </a></td>
            </tr>
            @endforeach
        </table>

    <?php echo $users->links(); ?>

    <p>Всего пользователей: {{ count(User::all()) }}</p>
    <p>Зарегистрировано сегодня: <?  count(DB::table('users')->where('created_at', '>=', '')); ?></p>
@endsection
