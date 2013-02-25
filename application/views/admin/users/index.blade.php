@layout('admin')

@section('content')
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="./index.html">5ok</a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="">
                        <a href="./index.html"></a>
                    </li>
                    <li class="active">
                        <a href="">Пользователи</a>
                    </li>
                    <li class="">
                        <a href="{{URL::to('admin/works') }}">Работа</a>
                    </li>
                    <li class="">
                        <a href="./base-css.html"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container">

<div class='row'>
        <div class="span12">
            <div class="span3 bs-docs-sidebar">
                <ul class="nav nav-list bs-docs-sidenav affix">
                    <li class=""><a href="#buttonGroups"><i class="icon-chevron-right"></i>Управление пользователями</a></li>
                    <li class=""><a href="#buttonGroups"><i class="icon-chevron-right"></i>Заявки на регистрацию</a></li>
                </ul>
            </div>

            <div class="span8">
                <section>

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
                                                <td>{{$user->name_and_surname}}</td>
                                                <td>{{$user->status}}</td>
                                                <td><a href="admin/user/edit/{{$user->id}}"?><ins class=" icon-edit"></ins> </a></td>
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
                                                <td>{{$employer->name_and_surname}}</td>
                                                <td>{{$employer->status}}</td>
                                                <td><a href="admin/user/edit/{{$user->id}}"?><ins class=" icon-edit"></ins> </a></td>
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
                </section>
            </div>
        </div>

    </div>
</div>
</div>
@endsection
