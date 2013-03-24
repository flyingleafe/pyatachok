<!doctype html>
<html>
<head>
    @yield('before_assets')
    {{ Asset::container('admin')->styles()  }}
    {{ Asset::container('admin')->scripts() }}
</head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="brand" href="/">5ok</a>
                <div class="nav-collapse collapse">
                    {{
                        Menu::handler('sineld', array('class' => 'nav'))
                        ->add('/', '<i class="icon-home"></i>На главную</a>')
                        ->add('#', '<i class="icon-edit"></i>Пользователи <b class="caret"></b>',


                        Menu::items('notify', array('class' => 'dropdown-menu'), 'ul')
                            ->add('admin/users/', '<i class="icon-pencil active"></i>Управление')
                            ->add('admin/users/registers', '<i class="icon-file"></i>Ждут активации')
                        , array('class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'), array('class'=>'dropdown'))

                        ->add('#', '<i class="icon-leaf"></i>Типы работ <b class="caret"></b>',

                        Menu::items('sellers', array('class' => 'dropdown-menu'), 'ul')
                            ->add('admin/jobtypes/', '<i class="icon-pencil"></i>Список')
                            ->add('admin/jobtypes/add', '<i class="icon-file"></i>Добавить')

                        , array('class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'), array('class'=>'dropdown'))

                        ->add('#', '<i class="icon-picture"></i>Статистика <b class="caret"></b>',

                        Menu::items('sellers', array('class' => 'dropdown-menu'), 'ul')
                            ->add('admin/home/stats', '<i class="icon-pencil"></i>Список')

                        , array('class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'), array('class'=>'dropdown'))

                        ->add('/admin', '<i class="icon-wrench"></i>Администратор <b class="caret"></b>',

                        Menu::items('admin', array('class' => 'dropdown-menu'), 'ul')
                            ->add('logout', '<i class="icon-user"></i>Выход')
                            ->add('/admin/home/profile', '<i class="icon-file"></i>Профайл')

                        , array('class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'), array('class'=>'dropdown')

                    )->render(array('active_child_class' => 'active', 'active_class' => 'active'));
                    }}
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
                        @yield('content')
                    </section>
                </div>
            </div>

        </div>
    </div>


</body>
</html>