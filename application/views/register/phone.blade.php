@layout('master')

@section('content')


    Ваш номер телефона: {{ Auth::user()->phone;}}

    <h1>Подтвердите ваш номер телефона:</h1>
    <p>На ваш телефон пришла смс с кододом подтверждения, пожалуйства введите кода в форму ниже:</p>
    @if($errors->has())


    @endif

    {{ Form::open('register/phone', 'POST', array('class' => '')) }}

    <p>1235 - временно</p>
    <div class="b-one__fieldset">
        {{ Form::label('code', 'Код подтверждения:')   }}
        {{ Form::text('code', '')  }}
    </div>

    {{ Form::submit('Отправить', array('class'=>'i-submit__button'))    }}
    {{ Form::button('Выслать ещё раз')  }}

    {{ Form::token() }}
    {{ Form::close() }}

@endsection