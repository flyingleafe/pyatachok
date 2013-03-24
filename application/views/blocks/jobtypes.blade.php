<? $jobtypes = Jobtype::All(); ?>
@if($jobtypes)
    <div class="b-jobtypes_inner">
        <h3>Выберите типы работ:</h3>
        <select id="select_job_types" class="chzn-select" name="jobtype_id">
            <option></option>
            @foreach($jobtypes as $job)
                <option value="{{$job->id}}">{{$job->name}}</option>
            @endforeach
        </select>
    </div>
@endif