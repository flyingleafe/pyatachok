


{{ Form::open('jobs/add', 'POST', array('class' => '')) }}


{{ Form::select('job_type', array('0'=>'Закрытая', '1'=>'Открытая'))    }}


{{ Form::submit('Продолжить', array('class'=>''))    }}

{{ Form::close();}}