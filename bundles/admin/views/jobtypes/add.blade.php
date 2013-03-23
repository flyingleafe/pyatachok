@layout('admin::master')


@section('content')
    <div class="b-form">
        <h3>Добавить тип работ</h3>

        @if($errors->has())
        {{ $errors->first('name', '<p class="alert alert-error">:message</p>') }}
        @endif

        <?php  echo View::make('admin::jobtypes._form' , array('model'=> $model));?>
    </div>
@endsection
