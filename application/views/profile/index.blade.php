@layout('master')

@section('content')

<div class="b-user-info">
    <h1>Личный кабинет</h1>
    <div class="b-one__fieldset">
        <label>Номер телефона:</label>
        {{ Auth::user()->phone;}}
    </div>

    <div class="b-one__fieldset">
        <label>Имя и фамилия:</label>
        {{ Auth::user()->name_and_surname;}}
    </div>
</div>
<a href="/">Назад</a>
@endsection