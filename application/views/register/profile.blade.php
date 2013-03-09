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

    <h3>Выберите ваш пол: </h3>

    <?php $gender = array(1=>'Мужской', 0=>'Женский') ?>
    <?php foreach($gender as $k=>$v){
        $checked = (Auth::user()->gender == $k);
    ?>
    <div class="b-one__fieldset">
        <label>{{$v}}</label>
        <input type="radio" name="gender" value="{{$k}}" <?if($checked) echo 'checked'?> />
    </div>
    <?}?>



    {{ Form::submit('Отправить', array('class'=>'i-submit__button'))    }}

    {{ Form::token() }}
    {{ Form::close() }}

@endsection