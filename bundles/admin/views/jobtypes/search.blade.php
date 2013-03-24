
@foreach($jobtypes as $jobtype)

    <tr>
        <td>{{$jobtype->name}}</td>
        <td>
            <a href="{{URL::to('admin/jobtypes/edit/').$jobtype->id}}"><ins class="icon icon-edit"></ins></a>
        </td>
    <tr>
@endforeach