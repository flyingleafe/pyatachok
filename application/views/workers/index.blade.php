@layout('master')

@section('before_assets')
    <script>
    var URLS = {
        workers_search : "{{ URL::to('workers/search') }}",
        workers_chosen : "{{ URL::to('workers/chosen') }}"
    }
    </script>
@endsection

@section('content')
    <div class="main">

        <div class="b-content">
            <div class="slogan">Найти рабочих: </div>
            @if($errors->has())
            {{ $errors->first('name', '<p>:message</p>') }}
            @endif


            <div class="search-workers">
                {{ Form::open('workers/search', 'POST', array('id'=>'search-workers', 'search-workers__form')) }}
                <div class="b-filter">
                    <div class="b-one__line">
                        <div class="b-one-col" style="width: 310px; border-right: 3px solid #fff; height: 133px">
                            <div class="b-jobtypes_inner">
                                <div class="b-jobtypes_inner__padder">
                                    @include('blocks.jobtypes')
                                </div>
                            </div>
                        </div>
                        <div class="b-one-col names">
                            <div class="b-one__fieldset">
                                {{ Form::label('name', 'Имя', array('class'=>''))    }}
                                {{ Form::text('name', '')    }}
                            </div>

                            <div class="b-one__fieldset">
                                {{ Form::label('created_at', 'На сайте', array('class'=>'' ))    }}
                                {{ Form::text('created_at', '', array('id'=>'created_at'))    }}
                            </div>
                        </div>
                        <div class="b-one-col gender">
                            <div class="b-one-group">
                                <h3>Пол</h3>
                                <div class="b-one__fieldset">
                                    {{ Form::label('gender', 'Любой', array('class'=>''))    }}
                                    {{ Form::radio('gender', '', array('checked'))    }}
                                </div>

                                <div class="b-one__fieldset">
                                    {{ Form::label('gender', 'Женский', array('class'=>''))    }}
                                    {{ Form::radio('gender', 0)    }}
                                </div>
                                <div class="b-one__fieldset">
                                    {{ Form::label('gender', 'Мужской', array('class'=>'' ))    }}
                                    {{ Form::radio('gender', 1)    }}
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="b-one__line sliders" style="border: none" >
                        <div class="b-one-col" style="float: left; width: 50%">
                            <div class="b-one-group" style="border-right: 3px solid #fff">
                                <div class="b-one-col">
                                    <h3>Возраст: </h3>
                                </div>
                                <div class="b-one-col">
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
                                <div class="clear"></div>
                            </div>

                        </div>
                        <div class="b-one-col" style="float: right; width: 50%">
                            <div class="b-one-group">
                                <div class="b-one-col">
                                    <h3>Зарплата: </h3>
                                </div>
                                <div class="b-one-col">
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
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <input type="button" value="Сбросить фильтр" id="reset_filter" class="red-button">
                {{ Form::close() }}
                <div class="clear"></div>



                <!--
                <div class="b-one__fieldset">
                    {{ Form::label('rating', 'Рейтинг', array('class'=>''))    }}
                    {{ Form::text('rating', '', array('id'=>'rating'))    }}
                </div>
                -->


                <!--
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
                -->
                <div class="left-col">
                    <div class="b-search">
                        @include('blocks.workers-results-hb')
                        <div class="workers-pagination"></div>
                        <div id="ajaxResponseSearch"></div>
                        <div class="workers-pagination"></div>
                    </div>
                </div>
                <div class="right-col">
                    @include('blocks.worker-chosen-list-hb')
                    <div class="clear"></div>
                </div>
            </div>

        </div>
    </div>
@endsection
