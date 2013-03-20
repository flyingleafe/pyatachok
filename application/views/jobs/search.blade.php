@if(isset($jobs))
<div class="b-results">
    @foreach($jobs as $job)
    <div class="b-one__job">
        <div><label>Имя :</label> <span>{{$job->name}}</span></div>
        <div><label>Оплата: </label> <span>{{$job->price}} руб</span></div>
        <div><label>Телефон: </label> <span>{{$job->phone}}</span></div>
        <a href="{{URL::to('jobs/view/').$job->id }}">Подробнее</a>
    </div>
    @endforeach
</div>
@endif


