@layout('master')

@section('content')



    Ваш номер телефона: {{ Auth::user()->phone;}}

    <h1>Личные данные</h1>

    @if($errors->has())
        {{ $errors->first('email',    '<p>:message</p>') }}
        {{ $errors->first('name_and_surname',    '<p>:message</p>') }}

    @endif


    {{ Form::open('register/create', 'POST', array('class' => 'b-user-register__form')) }}


    <div class="b-one__fieldset">
        {{ Form::label('email', 'Электронная почта:')   }}
        {{ Form::text('email', '')  }}
    </div>

    <div class="b-one__fieldset">
           {{ Form::label('name_and_surname', 'Фамилия и Имя:') }}
           {{ Form::text('surname', '');}}
    </div>


    {{ Form::submit('Отправить', array('class'=>'i-submit__button'))    }}

    {{ Form::close();}}

@endsection