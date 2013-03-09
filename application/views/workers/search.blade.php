@if(isset($workers))
<div class="b-results">
    @foreach($workers->results as $worker)
    <div class="b-one__worker">
        <label>Выбрать :</label> <input type="checkbox"/ >
        <div class="b-worker_name"><label>Имя :</label> <span>{{$worker->name}}</span></div>
        <div class="b-worker_cost"><label>Телефон: </label> <span>{{$worker->phone}}</span></div>
        @if(isset($worker->jobtype_id))
        <div class="b-worker_cost">Стоимость: {{$worker->cost}} руб./час</div>
        @endif
    </div>
    @endforeach
    <?php echo $workers->links(); ?>
</div>
@endif


<script>
    $(function(){
        $('.pagination li a').click(function(event){
            event.preventDefault();
            var page =  $(this).text();
            return false;
        });
    })

</script>