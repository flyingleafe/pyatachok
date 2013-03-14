@layout('admin::master')

@section('content')
<div class="well">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#home" data-toggle="tab">Профиль</a></li>
        <li><a href="#profile" data-toggle="tab">Пароль</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane active in" id="home">
            {{-- Form::open(URL::to('admin/users/edit'.$user->id), 'POST', ) --}}
            <form id="tab" method="POST" action="{{URL::to('admin/users/edit/')}}{{$user->id}}">
                <label>Телефон: </label>
                <input type="text" name="phone" value="{{$user->phone}}" class="input-xlarge">
                <label>Имя и Фамилия: </label>
                <input type="text" value="{{$user->name}}" name="name" class="input-xlarge">

                <label>Статус</label>

                <select name="status">
                    @foreach(User::$stats_type as $code=>$status)
                        <option <?if($code==$user->status) echo 'selected'?> value="{{$code}}">{{$status}}</option>
                    @endforeach
                </select>

                <label>Тип аккаунта</label>
                <select name="is_worker">
                    @foreach(User::$acc_type as $k=>$type)
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
