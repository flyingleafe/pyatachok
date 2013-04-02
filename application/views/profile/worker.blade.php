@layout('master')

@section('before_assets')

    <script type="text/javascript">
    var URLS = {
        job_delete: '{{ URL::to("profile/delete_job") }}'
    }
    </script>

@endsection

@section('content')

    @include('blocks.header')
    
    <a href="/">Назад</a>
    <div class="b-user-info">
        <h1>Личный кабинет</h1>
        <a href="{{URL::to('profile/edit') }}">Редактировать информацию</a>
        <br>
        <br>


        @if(isset( Auth::user()->avatar_url))
            {{ HTML::image('/storage/images/'.Auth::user()->avatar_url,''); }}
        @endif
        <br>
        <br>
        <label>Загрузка фотографий: </label>
        {{Form::open_for_files('profile/upload', 'POST')}}
            {{Form::file('photo')}}
            {{Form::submit('загрузить')}}
        {{Form::close()}}
        <br>
        <br>
        @if(Session::has('errors'))
        <?php $errors = Session::get('errors'); ?>
        {{ $errors->first('image_type', '<p class="form__error">:message</p>') }}
        @endif
        <br>
        <br>

        <div class="b-one__fieldset">
            <label>Номер телефона:</label>
            <span>{{ Auth::user()->phone;}}</span>
        </div>

        <div class="b-one__fieldset">
            <label>Имя и фамилия:</label>
            <span>{{ Auth::user()->name }}</span>
        </div>

         <div class="b-one__fieldset">
            <label>Пол: </label>
            <? $gender = array(0=>'Женский', 1=>'Мужской' ) ?>
            <span>{{ $gender[Auth::user()->gender] }}</span>
         </div>

        <?php $jobtypes = Jobtype::All(); ?>




        {{ Form::open('profile/update', 'POST', array('class' => '')) }}
        @if($jobtypes)

            <div class="b-jobtypes_inner">
                <h3>Выберите типы работ:</h3>

                <select id="select_job_types" class="chzn-select" multiple>
                    <?php foreach($jobtypes as $job) : ?>
                        <option <?php if(array_key_exists($job->id, $user_jobtypes)) echo 'selected' ?> value="{{$job->id}}">{{$job->name}}</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input id="add_job_types" type="button" value="Добавить" style="float: left">

        <div class="clear"></div>
        <div class="b-selected-job">
            <div class="b-user-job head">
                <span class="b-jobtype__label">Тип работ:</span>
                <span class="b-jobcost__label">Стоимость</span>
                <div class="clear"></div>
            </div>

            @if( $errors->has())
                {{ $errors->first('cost', '<p class="form__error">:message</p>') }}
            @endif

            <?php foreach ($user_jobtypes as $user_job=>$const) : ?>
                <div class="b-user-job" id="jobtype_{{$user_job}}">
                     <span class="b-jobtype__label"><?echo Jobtype::find($user_job)->name ?></span>
                     <span class="b-jobcost__label"><input type="text" name="cost[]" value="{{$const}}"> <ins>руб/час</ins></span>
                     <input type="hidden"  name="job_ids[]" value="{{$user_job}}">
                     <div class="clear"></div>
                </div>
            <?php endforeach; ?>
        </div>
        {{ Form::submit('Сохранить', array('class'=>'')) }}
        
        @endif

        {{ Form::close();}}
    </div>

@endsection