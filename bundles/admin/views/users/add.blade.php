@layout('admin::master')

@section('content')

<a href="{{URL::to('admin/users/сontrol')}}">
    <input type="button" class="btn btn-primary" value="Вернуться">
</a>
    <br/>
    <br/>
    {{ Form::open('admin/users/add', 'POST', array('class' => '')) }}
        <label>Логин: </label>
        <input type="text" name="phone">

        <label>Пароль: </label>
        <input type="password" name="password">

        <label>Подтверждение: </label>
        <input type="password" name="password_confirmation">

        <?php $roles = array('1'=>'Модератор', '2'=>'Администратор')?>

        <label>Выберите роль: </label>
        <select name="role">
            @foreach($roles as $key=>$role)
                <option value="{{$key}}"> {{$role}} </option>
            @endforeach
        </select>
    <br/>
    {{ Form::submit('Добавить', array('class'=>'btn btn-info'))    }}

    {{ Form::close() }}
@endsection
