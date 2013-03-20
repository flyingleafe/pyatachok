@layout('master')

@section('before_assets')
    <script>
    var URLS = {
        workers_search : "{{ URL::to('workers/search') }}"
    }
    </script>
@endsection

@section('content')

@include('blocks.header')

<div class="container">
    <div class="b-content">
        <h1>Найти рабочих</h1>

        @if($errors->has())
        {{ $errors->first('name', '<p>:message</p>') }}
        @endif

        {{ Form::open('workers/search', 'POST', array('class' => 'b-form', 'id'=>'search-workers')) }}

        @include('blocks.jobtypes')

        <div class="b-one__fieldset">
            {{ Form::label('name', 'Имя и Фамилия', array('class'=>''))    }}
            {{ Form::text('name', '')    }}
        </div>

        <div class="b-one__fieldset">
            {{ Form::label('created_at', 'На сайте', array('class'=>'' ))    }}
            {{ Form::text('created_at', '', array('id'=>'created_at'))    }}
        </div>

        <div class="b-one__fieldset">
            {{ Form::label('rating', 'Рейтинг', array('class'=>''))    }}
            {{ Form::text('rating', '', array('id'=>'rating'))    }}
        </div>

        <div class="b-one-group">
            <h3>Пол</h3>
            <div class="b-one__fieldset">
                {{ Form::label('gender', 'Без разницы', array('class'=>''))    }}
                {{ Form::radio('gender', '', array('checked'))    }}
            </div>

            <div class="b-one__fieldset">
                {{ Form::label('gender', 'Женский', array('class'=>''))    }}
                {{ Form::radio('gender', 0)    }}
            </div>
            <div class="b-one__fieldset">
                {{ Form::label('gender', 'Мужской', array('class'=>'' ))    }}
                {{ Form::radio('gender', 1 )    }}
            </div>
        </div>

        <div class="b-one-group">
            <h3>Бригада</h3>

            <div class="b-one__fieldset">
                {{ Form::label('team', 'Без разницы', array('class'=>''))    }}
                {{ Form::radio('team', '', array('checked'))    }}
            </div>

            <div class="b-one__fieldset">
                {{ Form::label('team', 'Нет', array('class'=>'',))    }}
                {{ Form::radio('team', 0)    }}
            </div>

            <div class="b-one__fieldset">
                {{ Form::label('team', 'Есть', array('class'=>'',))    }}
                {{ Form::radio('team', 1)    }}
            </div>
        </div>


        <div class="b-one-group">
            <h3>Возраст</h3>
            <div id="age_slider"></div>
            <div class="b-one__fieldset">
                {{ Form::label('age_min', 'От', array('class'=>'',))    }}
                {{ Form::text('age_min', '', array( 'id'=>'age_min'))    }}
            </div>
            <div class="b-one__fieldset">
                {{ Form::label('age_max', 'До', array('class'=>''))    }}
                {{ Form::text('age_max', '', array( 'id'=>'age_max'))    }}
            </div>
        </div>


        <div class="b-one-group">
            <h3>Зарплата</h3>
            <div id="cost_slider"></div>
            <div class="b-one__fieldset">
                {{ Form::label('cost_min', 'От', array('class'=>'',))    }}
                {{ Form::text('cost_min', '', array( 'id'=>'cost_min'))    }}
            </div>
            <div class="b-one__fieldset">
                {{ Form::label('cost_max', 'До', array('class'=>''))    }}
                {{ Form::text('cost_max', '', array( 'id'=>'cost_max'))    }}
            </div>
        </div>

        {{ Form::close();}}

        <input type="button" value="Сбросить фильтр" id="reset_filter">
        <div id="ajaxResponceSearch"></div>
    </div>
</div>
@endsection