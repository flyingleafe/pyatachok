@layout('admin::master')

@section('content')
    <?php $user= Auth::user();?>
    <h3>Ваш профайл</h3>
    <table class="table table-bordered">
        <tr>
            <td>Логин</td>
            <td>{{$user->phone}}</td>
        </tr>
         <tr>
            <td>Дата регистрации</td>
            <td>{{$user->created_at}}</td>
        </tr>
    </table>

    @if(Session::has('errors'))
    <?php $errors = Session::get('errors'); ?>
    {{ $errors->first('password', '<p class="alert alert-error">:message</p>') }}
    {{ $errors->first('new_password', '<p class="alert alert-error">:message</p>') }}
    @endif

    @if(Session::has('message'))
        <?php $message = Session::get('message'); ?>
        {{ $message->first('password', '<p class="alert alert-info">:message</p>') }}
    @endif

    <form method="POST" action="{{URL::to('admin/home/profile')}}">
        <label>Текущий пароль</label>
        <input type="password" name="current_password"/>
        <label>Новый пароль</label>
        <input type="password" name="new_password"/>
        <label>Подтверждение</label>
        <input type="password" name="new_password_confirmation"/>
        <br/>
        <input type="submit" class="btn btn-primary" value="Сохранить">
    </form>

@endsection