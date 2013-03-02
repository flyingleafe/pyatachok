@layout('master')

@section('content')



    Ваш номер телефона: {{ Auth::user()->phone;}}

    <h1>Личные данные</h1>

    @if($errors->has())
        {{ $errors->first('name', '<p>:message</p>') }}
    @endif


    {{ Form::open('register/profile', 'POST', array('class' => 'b-user-register__form')) }}


    <!--div class="b-one__fieldset">
        {{ Form::label('email', 'Электронная почта:')   }}
        {{ Form::text('email', '')  }}
    </div-->

    <div class="b-one__fieldset">
           {{ Form::label('name', 'Фамилия и Имя:') }}
           {{ Form::text('name', Auth::user()->name);}}
    </div>


    {{ Form::submit('Отправить', array('class'=>'i-submit__button'))    }}

    {{ Form::close();}}

@endsection