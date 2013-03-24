@layout('admin::master')


@section('content')
    <div class="b-form">
        <h3>Добавить тип работ</h3>

        @if($errors->has())
        {{ $errors->first('name', '<p class="alert alert-error">:message</p>') }}
        @endif

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

    </div>
@endsection
