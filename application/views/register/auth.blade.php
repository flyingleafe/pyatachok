@layout('master')

@section('content')
        <h1>Авторизация</h1>

    @if($errors->has())
        {{ $errors->first('auth', '<p>:message</p>') }}

    @endif


    {{ Form::open('register/auth', 'POST', array('class' => 'b-user-auth__form')) }}


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
@endsection
