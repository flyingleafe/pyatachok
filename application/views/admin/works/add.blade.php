@layout('admin')



<div class="b-form">
    <h1>Добавить тип работ</h1>

    {{ Form::open('admin/works/add', 'POST', array('class' => '')) }}

    @if($errors->has())
    {{ $errors->first('name', '<p class="form__error">:message</p>') }}
    @endif


    <div class="b-one__fieldset">
        {{ Form::label('name', 'Название:') }}
        {{ Form::text('name') }}
    </div>



    <div class="form-actions">
        {{ Form::submit('Отправить', array('class'=>'btn btn-primary'))    }}
        <a class="btn" href="{{URL::to('admin/works') }}">Отмена</a>
    </div>
    {{ Form::close() }}
</div>
