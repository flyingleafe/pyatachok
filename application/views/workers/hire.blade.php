@layout('master')

@section('before_assets')
    <script>
    var URLS = {
        workers_chosen : "{{ URL::to('workers/chosen') }}"
    }
    </script>
@endsection

@section('content')
    @include('blocks.header')
    <h1>workers.hire</h1>

    <p>This is the 'workers.hire' view.</p>
@endsection
