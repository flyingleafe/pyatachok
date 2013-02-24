@layout('master')

@section('content')

    <div class="b-form b-auth__form">
        <h1>Авторизация</h1>



        @if(isset($auth_errors) AND $auth_errors->has())
        {{ $auth_errors->first('auth', '<p class="form__error">:message</p>') }}
        {{ $auth_errors->first('phone', '<p class="form__error">:message</p>') }}
        {{ $auth_errors->first('password', '<p class="form__error">:message</p>') }}
        @endif


        {{ Form::open('register/auth', 'POST', array('class' => '')) }}


            <div class="b-one__fieldset">
                   {{ Form::label('phone', 'Имя пользователя:') }}
                   {{ Form::text('phone', '');}}
            </div>

            <div class="b-one__fieldset">
                   {{ Form::label('password', 'Пароль'); }}
                   {{ Form::password('password')    }}
            </div>


            {{ Form::submit('Отправить', array('class'=>'i-submit__button'))    }}

        {{ Form::close() }}
    </div>

    <div class="b-form b-register__form">
        <h1>Регистрация пользователей</h1>

        @if(isset($register_errors) && $register_errors->has())
        {{ $register_errors->first('phone', '<p class="form__error">:message</p>') }}
        {{ $register_errors->first('password', '<p class="form__error">:message</p>') }}
        {{ $register_errors->first('password_confirmation', '<p class="form__error">:message</p>') }}
        @endif


        {{ Form::open('register/create', 'POST', array('class' => '')) }}

        <div class="b-one__fieldset">
            {{ Form::label('phone', 'Телефон:') }}
            {{ Form::text('phone', '')    }}
        </div>



        <div class="b-one__fieldset">
            {{ Form::label('password', 'Пароль: '); }}
            {{ Form::password('password')    }}
        </div>

        <div class="b-one__fieldset">
            {{ Form::label('confirmed', 'Подтверждение пароля') }}
            {{ Form::password('password_confirmation')   }}
        </div>

        <div class="b-one__fieldset">
            {{ Form::label('is_worker', 'Тип аккаунта:') }}
            {{ Form::select('is_worker', array('1' => 'Работник', '0' => 'Работодатель'));}}
        </div>


        {{ Form::submit('Отправить', array('class'=>'i-submit__button'))    }}

        {{ Form::close();}}
    </div>

@endsection
