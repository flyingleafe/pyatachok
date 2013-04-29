@layout('master')

<style>

</style>
@section('content')
    <div class='main'>
        <div class="user-info">
            <a href="/workers" class="back-to-workers">К списку пользователей</a>
            <div class="slogan">{{ $user->name }}</div>

            <div class="avatar">
                {{ $avatar }}
            </div>

            <div>
                {{ View::make('blocks.user-profile', array('user'=>$user))}}

                <table class="info">
                    <tr>
                        <th>Тип работ: </th>
                        <th>Стоимость: </th>
                    </tr>
                    <?php foreach($jobtypes as $job) : ?>
                       <tr>
                            <td> {{Jobtype::find($job->jobtype_id)->name}}  </td>
                            <td> {{$job->cost}}руб/час</td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
@endsection
