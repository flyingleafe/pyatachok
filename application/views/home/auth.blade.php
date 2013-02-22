@layout('master')http://codehappy.daylerees.com/authentication

@section('content')
        <h1>Авторизация</h1>

    @if($errors->has())
        {{ $errors->first('username', '<p>:message</p>') }}
        {{ $errors->first('password', '<p>:message</p>') }}
    @endif


    {{ Form::open('home/auth', 'POST', array('class' => 'b-user-auth__form')) }}


        <div class="b-one__fieldset">
               {{ Form::label('username', 'Имя пользователя:') }}
               {{ Form::text('username', '');}}
        </div>

        <div class="b-one__fieldset">
               {{ Form::label('password', 'Пароль'); }}
               {{ Form::password('password')    }}
        </div>

        {{ Form::submit('Отправить', array('class'=>'i-submit__button'))    }}

    {{ Form::close() }}
@endsection
