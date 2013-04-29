@layout('master')

@section('before_assets')
<script type="text/javascript" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    var URLS = {
        job_delete: '{{ URL::to("profile/delete_job") }}'
    }
    </script>
@endsection


@section('content')
    <div class="main">
        <div class="user-info">

            <div class="slogan">Личный кабинет </div>
            <a href="/">← Назад</a></br>

            <!--a class="edit-info" href="{{URL::to('profile/edit') }}">Редактировать информацию</a--></br>


            <div class="avatar">
                {{ Auth::user()->getAvatar(); }}
            </div>

            <label>Загрузка фотографий: </label>
            {{Form::open_for_files('profile/upload', 'POST')}}
                {{Form::file('photo')}}
                {{Form::submit('загрузить' ,array('class'=>'red-button'))}}
            {{Form::close()}}
            <br>
            <br>
            @if(Session::has('errors'))
            <?php $errors = Session::get('errors'); ?>
            {{ $errors->first('image_type', '<p class="form__error">:message</p>') }}
            @endif
            <br>
            <br>

            {{ View::make('blocks.user-profile', array('user'=>Auth::user()))}}


            <?php $jobtypes = Jobtype::All(); ?>


            {{ Form::open('profile/update', 'POST', array('class' => 'add-jobtype')) }}
            @if($jobtypes)

                <div class="b-jobtypes_inner">
                    <h3>Выберите типы работ:</h3>

                    <select id="select_job_types" class="chzn-select" multiple>
                        <?php foreach($jobtypes as $job) : ?>
                            <option <?php if(array_key_exists($job->id, $user_jobtypes)) echo 'selected' ?> value="{{$job->id}}">{{$job->name}}</option>
                        <?php endforeach; ?>
                    </select>
                    </br>
                    <input id="add_job_types"  class='red-button' type="button" value="Добавить" >
                </div>


            <div class="clear"></div>

            @if( $errors->has())
                {{ $errors->first('cost', '<p class="form__error">:message</p>') }}
            @endif

            <table class="info b-selected-job">
             <tr>
                 <th>Тип работ:</th>
                 <th>Стоимость:
             </tr>
                <?php foreach ($user_jobtypes as $user_job=>$const) : ?>
                <tr id="jobtype_{{$user_job}}">
                     <td><?echo Jobtype::find($user_job)->name ?></td>
                     <td>
                         <input type="text" class="cost-input" name="cost[]" value="{{$const}}"> <ins>руб. / час</ins>
                         <input type="hidden"  name="job_ids[]" value="{{$user_job}}">
                     </td>
                 </tr>
                <?php endforeach; ?>
            </table>
            {{ Form::submit('Сохранить', array('class'=>'red-button save-jobtypes')) }}
            @endif

            {{ Form::close();}}
        </div>
    </div>
@endsection

