@layout('master')

@section('before_assets')
<script>
    var URLS = {
        jobs_search : "{{ URL::to('jobs/search') }}"
    }
</script>
@endsection

@section('content')

@include('blocks.header')

<div class="container">
    <h1>Найти работу</h1>

    @if($errors->has())
    {{ $errors->first('name', '<p>:message</p>') }}
    @endif

    {{ Form::open('jobs/search', 'POST', array('class' => 'b-form', 'id'=>'search-jobs')) }}

        @include('blocks.jobtypes')

        <h3>Дата работ</h3>
        <div class="b-one__fieldset">
            {{ Form::label('start_date', 'Дата начала', array('class'=>''))    }}
            {{ Form::text('start_date', '',  array('id'=>'start_date'))    }}
        </div>
        <div class="b-one__fieldset">
            {{ Form::label('end_date', 'Дата окончания', array('class'=>''))    }}
            {{ Form::text('end_date', '', array('id'=>'end_date'))    }}
        </div>


        <h3>Зарплата</h3>
        <div class="b-one__fieldset">
            <div id="cost_slider"></div>
            {{ Form::label('cost_min', 'От', array('class'=>''))    }}
            {{ Form::text('cost_min', 0)    }}
        </div>
        <div class="b-one__fieldset">
            {{ Form::label('cost_max', 'До', array('class'=>''))    }}
            {{ Form::text('cost_max', 0)    }}
        </div>

        {{ Form::submit('Искать', array('class'=>''))    }}
        <input type="button" value="Сбросить фильтр" id="reset_filter">
    {{ Form::close();}}

    @include('blocks.jobs-results-hb')
    <div class="jobs-pagination"></div>
    <div id="ajaxResponseSearch"></div>
    <div class="jobs-pagination"></div>
</div>
@endsection


