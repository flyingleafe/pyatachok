@layout('admin::master')

@section('content')

    <a href="{{URL::to('admin/users/add')}}">
        <input type="button" class="btn btn-primary" value="Добавить">
    </a>

    <br/>
    <br/>
    <?php
        $users = DB::table('users')
        ->where_in('role',  array(1,2))
        ->get();

    ?>
    @if($users)
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Логин</th>
                <th>Роль</th>
                <th>Редактировать</th>
            </tr>
            <?php $roles = array('1'=>'Модератор', '2'=>'Администратор')?>

                @foreach($users as $user)
                <tr>
                    <th>{{$user->id}}</th>
                    <th>{{$user->phone}}</th>
                    <th>{{ $roles[$user->role] }}</th>

                    <th style="text-align: center">
                        <a href="{{URL::to('admin/users/edit/')}}{{$user->id}}">
                        <ins class="icon icon-edit" ></ins>
                        </a>
                    </th>
                </tr>
                @endforeach
        </table>
    @else
        <div class="alert">Добавьте модератора или администратора</div>
    @endif

@endsection
