@if(isset($workers))
    <table class="results">
        <thead>
            <tr>
                <th>Имя</th>
                <th>Телефон</th>
                @if($has_jobtype)
                    <th>Стоимость</th>
                @endif
                <th>Выбрать</th>
            </tr>
        </thead>
            @foreach($workers->results as $worker)
                <tr class="worker">
                    <td class="worker_name"><span>{{ $worker->name }}</span></td>
                    <td class="worker_phone"><span>{{ $worker->phone }}</span></td>
                    @if($has_jobtype)
                        <td class="worker_cost">{{ $worker->cost }} руб./час</td>
                    @endif
                    <td class="worker_choose"><input type="checkbox"/ ></td>
                </tr>
            @endforeach
    </table>
    {{ $workers->links() }}
@endif


