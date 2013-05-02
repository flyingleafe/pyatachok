@layout('master')

@section('before_assets')
<script>
    var URLS = {
        jobs_search : "{{ URL::to('jobs/search') }}"
    }
</script>
@endsection

@section('content')

<div class="container">
    <div class="main">
        <div class="slogan">Найти работу: </div>
        @if($errors->has())
        {{ $errors->first('name', '<p>:message</p>') }}
        @endif

        <div class="search-jobs">
            <div class="search-jobs__padder">
                {{ Form::open('jobs/search', 'POST', array( 'id'=>'search-jobs')) }}

                    @include('blocks.jobtypes')

                    <div class="clear"></div>
                    <div class="col left-col">
                        <h3>Дата работ: </h3>
                        <div class="b-one__fieldset">
                            {{ Form::label('start_date', 'Дата начала', array('class'=>''))    }}
                            {{ Form::text('start_date', '',  array('id'=>'start_date', 'readonly'=>'true'))    }}
                        </div>
                        <div class="b-one__fieldset">
                            {{ Form::label('end_date', 'Дата окончания', array('class'=>''))    }}
                            {{ Form::text('end_date', '', array('id'=>'end_date', 'readonly'=>'true'))    }}
                        </div>
                    </div>


                    <div class="col right-col">
                        <h3>Зарплата: </h3>
                        <div class="b-one__fieldset">
                            <div id="cost_slider"></div>
                            {{ Form::label('cost_min', 'От', array('class'=>''))    }}
                            {{ Form::text('cost_min', 0)    }}
                        </div>
                        <div class="b-one__fieldset">
                            {{ Form::label('cost_max', 'До', array('class'=>''))    }}
                            {{ Form::text('cost_max', 0)    }}
                        </div>
                    </div>
                {{ Form::close();}}
                <div class="clear"></div>
            </div>
        </div>

        <input type="button" value="Сбросить фильтр" id="reset_filter" class="red-button">
        @include('blocks.jobs-results-hb')
        <div class="jobs-pagination"></div>
        <div id="ajaxResponseSearch" class="responce"></div>
        <div class="jobs-pagination"></div>
    </div>
</div>
@endsection


