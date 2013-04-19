<? $jobtypes = Jobtype::All(); ?>
@if($jobtypes)
    <h3>Тип работы</h3>
    <select id="select_job_types" class="chzn-select" name="jobtype_id" required>
        <option></option>
        @foreach($jobtypes as $job)
            <option value="{{$job->id}}">{{$job->name}}</option>
        @endforeach
    </select>
@endif