@layout('master')

@section('content')


    <h1>Регистрация пользователей</h1>

    @if($errors->has())
        {{ $errors->first('phone', '<p>:message</p>') }}
        {{ $errors->first('password', '<p>:message</p>') }}
    @endif

        
    {{ Form::open('register/create', 'POST', array('class' => 'b-user-register__form')) }}

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


    {{ Form::submit('Отправить', array('class'=>'i-submit__button'))    }}

    {{ Form::close();}}

@endsection