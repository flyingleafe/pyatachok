{{ Form::open('admin/jobtypes/add', 'POST', array('class' => '')) }}

<div class="b-one__fieldset">
    {{ Form::label('name', 'Название:') }}
    {{ Form::text('name', $model->name) }}
</div>


<div class="form-actions">
    {{ Form::submit('Отправить', array('class'=>'btn btn-primary'))    }}
    <a class="btn" href="{{URL::to('admin/jobtypes') }}">Отмена</a>
</div>
{{ Form::close() }}