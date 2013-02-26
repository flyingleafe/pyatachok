@layout('admin')

@section('content')
<div class="well">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#home" data-toggle="tab">Профиль</a></li>
        <li><a href="#profile" data-toggle="tab">Пароль</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane active in" id="home">
            <form id="tab" method="POST" action="{{URL::to('admin/users/edit/')}}{{$user->id}}">
                <label>Телефон: </label>
                <input type="text" name="phone" value="{{$user->phone}}" class="input-xlarge">
                <label>Имя и Фамилия: </label>
                <input type="text" value="{{$user->name_and_surname}}" name="name_and_surname" class="input-xlarge">

                <label>Статус</label>
                <input type="hidden" name="id" value="{{$user->id}}">
                <?
                $stats_type = array(
                    -1=>'Заблокирован',
                    0=>'Подтверждение телефона',
                    1=>'Заполнение информации',
                    2=>'Акивен',
                )
                ?>
                <select name="status">
                    @foreach($stats_type as $code=>$status)
                    <option <?if($code==$user->status) echo 'selected'?> value="{{$code}}">{{$status}}</option>
                    @endforeach
                </select>

                <label>Тип аккаунта</label>
                <?
                $acc_type = array(
                    0=>'Работадатель',
                    1=>'Рабочий',
                );
                ?>
                <select name="is_worker">
                    @foreach($acc_type as $k=>$type)
                    <option <?if($k== (int) $user->is_worker) echo 'selected'?> value="{{$k}}">{{$type}}</option>
                    @endforeach
                </select>

                <label>Email</label>
                <input type="text" value="jsmith@yourcompany.com" class="input-xlarge">

                <label>Информация</label>
                <textarea name="about" rows="3" class="input-xlarge">
                    {{$user->about}}
                </textarea>


                <div>
                    <button class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="profile">
            <form id="tab2">
                <label>Новый пароль</label>
                <input type="password" class="input-xlarge">
                <div>
                    <button class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
