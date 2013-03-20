@if(isset($jobs))
<div class="b-results">
    @foreach($jobs as $job)
    <div class="b-one__worker">
        <label>Выбрать :</label> <input type="checkbox"/ >
        <div class="b-worker_name"><label>Имя :</label> <span>{{$job->jobtype_id}}</span></div>
        <div class="b-worker_cost"><label>Оплата: </label> <span>{{$job->price}}</span></div>
        <div class="b-worker_cost"><label>Оплата: </label> <span>{{$job->phone}}</span></div>

    </div>
    @endforeach
</div>
@endif


