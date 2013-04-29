@layout('master')

@section('content')
<div class="main" xmlns="http://www.w3.org/1999/html">
        <div class="slogan" style="padding: 30px 0">Оставить отзыв: </div>
        {{ Form::open('jobs/create', 'POST', array('class' => '')) }}
        <table class="table-red">
            <tr>
                <th colspan="2">
                   Оставить отзыв
                </th>
            </tr>

            <tr>
                <td>
                    Ваше имя:
                </td>
                <td>
                    {{ Form::text('name', '',  array('id'=>'name') )    }}
                </td>
            </tr>
            <tr>
                <td>
                    Cообщение:
                </td>
                <td>
                    {{ Form::textArea('message', '',  array('id'=>'message') )    }}
                </td>
            </tr>
        </table>
        </br>
        </br>
        {{ Form::submit('Отправить', array('class'=>'red-button'))    }}

        {{ Form::close();}}
    </div>
@endsection