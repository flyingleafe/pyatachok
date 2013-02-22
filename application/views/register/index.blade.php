@layout('master')

@section('content')


    <h1>Регистрация пользователей</h1>

    @if($errors->has())

        {{ $errors->first('username', '<p>:message</p>') }}
        {{ $errors->first('email',    '<p>:message</p>') }}
        {{ $errors->first('name',    '<p>:message</p>') }}
        {{ $errors->first('surname', '<p>:message</p>') }}
        {{ $errors->first('password', '<p>:message</p>') }}
    @endif

        
    {{ Form::open('register/create', 'POST', array('class' => 'b-user-register__form')) }}

    <div class="b-one__fieldset">
        {{ Form::label('username', 'Логин:') }}
        {{ Form::text('username', '')    }}
    </div>

    <div class="b-one__fieldset">
        {{ Form::label('email', 'Электронная почта:')   }}
        {{ Form::text('email', '')  }}
    </div>

     <div class="b-one__fieldset">
        {{ Form::label('name', 'Ваше имя:') }}
        {{ Form::text('name', '')   }}
    </div>

    <div class="b-one__fieldset">
           {{ Form::label('surname', 'Ваше фамилия:') }}
           {{ Form::text('surname', '');}}
    </div>

    <div class="b-one__fieldset">
           {{ Form::label('password', 'Пароль'); }}
           {{ Form::password('password')    }}
    </div>

    <div class="b-one__fieldset">
           {{ Form::label('confirmed', 'Подтверждение пароля') }}
           {{ Form::password('password_confirmation')   }}
    </div>


    {{ Form::submit('Отправить', array('class'=>'i-submit__button'))    }}

    {{ Form::close();}}

@endsection