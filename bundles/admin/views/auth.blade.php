@layout('admin::blank')

@section('content')
<form class="form-horizontal" action='' method="POST" style="width: 600px; margin: 0 auto">
    <fieldset>
        <div id="legend">
            <legend class="">5ok: Панель управления</legend>
        </div>
        <div class="control-group">
            <!-- Username -->
            <label class="control-label"  for="username">Имя пользователя</label>
            <div class="controls">
                <input type="text" id="username" name="Имя пользователя" placeholder="" class="input-xlarge">
            </div>
        </div>

        <div class="control-group">
            <!-- Password-->
            <label class="control-label" for="password">Пароль</label>
            <div class="controls">
                <input type="password" id="password" name="Пароль" placeholder="" class="input-xlarge">
            </div>
        </div>


        <div class="control-group">
            <!-- Button -->
            <div class="controls">
                <button class="btn btn-success">войти</button>
            </div>
        </div>
    </fieldset>
</form>
@endsection