@layout('master')

@section('content')

<div class="main">
    <div class="b-form b-register__form tile">
        <div class="spiral"></div>
        <h1>Регистрация пользователей</h1>

        {{ Form::open('register/create', 'POST', array('class' => '')) }}

        @if(Session::has('register_errors'))
            <?php $register_errors = Session::get('register_errors'); ?>
            {{ $register_errors->first('phone', '<p class="form__error">:message</p>') }}
            {{ $register_errors->first('password', '<p class="form__error">:message</p>') }}
            {{ $register_errors->first('password_confirmation', '<p class="form__error">:message</p>') }}
        @endif

        <div class="b-one__fieldset">
            {{-- Form::label('phone', 'Телефон:') --}}
            {{ Form::text('phone', '', array('placeholder' => 'Телефон')) }}
        </div>

        <div class="b-one__fieldset">
            {{-- Form::label('password', 'Пароль: ') --}}
            {{ Form::password('password', array('placeholder' => 'Пароль')) }}
        </div>

        <div class="b-one__fieldset">
            {{-- Form::label('confirmed', 'Подтверждение пароля') --}}
            {{ Form::password('password_confirmation', array('placeholder' => 'Подтверждение пароля')) }}
        </div>

        <div class="b-one__fieldset">
            {{ Form::label('is_worker', 'Тип аккаунта:') }}
            {{ Form::select('is_worker', array('1' => 'Работник', '0' => 'Работодатель')) }}
        </div>

        {{ Form::submit('Зарегистрироваться', array('class'=>'i-submit__button')) }}

        {{ Form::token() }}
        {{ Form::close() }}
    </div>

    <div class="b-form b-auth__form tile">
        <div class="spiral"></div>
        <h1>Авторизация</h1>

        {{ Form::open('register/auth', 'POST', array('class' => '')) }}

        @if(Session::has('auth_errors'))
            <?php $auth_errors = Session::get('auth_errors'); ?>
            {{ $auth_errors->first('auth', '<p class="form__error">:message</p>') }}
            {{ $auth_errors->first('phone', '<p class="form__error">:message</p>') }}
            {{ $auth_errors->first('password', '<p class="form__error">:message</p>') }}
        @endif

        <div class="b-one__fieldset">
            {{-- Form::label('phone', 'Телефон') --}}
            {{ Form::text('phone', '', array('placeholder' => 'Телефон')) }}
        </div>

        <div class="b-one__fieldset">
            {{-- Form::label('password', 'Пароль') --}}
            {{ Form::password('password', array('placeholder' => 'Пароль')) }}
        </div>

        {{ Form::submit('Войти', array('class'=>'i-submit__button')) }}

        {{ Form::token() }}
        {{ Form::close() }}
    </div>
</div>

@endsection

