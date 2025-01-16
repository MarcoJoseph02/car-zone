@php
    $disabled = false;
         if($row){
        if (\Carbon\Carbon::parse($row->date . ' ' . $row->start_time)->lessThanOrEqualTo(\Carbon\Carbon::now())) {
            $disabled = true;
        }
        }
@endphp
        @include('form.input',['type'=>'text','name'=>"content",'value'=> $row->content,
        'attributes'=>['class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('courses.Session content'),'placeholder'=>trans('courses.Session content'),'required'=>'required']])

        @include('form.input',['type'=>'date','name'=>"date",'value'=> $row->date,
        'attributes'=>['class'=>'form-control nowdatepicker','col-class'=>"col-md-6",'label'=>trans('courses.Session date'),'placeholder'=>trans('courses.Session date'),'required'=>'required','disabled'=> $disabled]])

        @include('form.input',['type'=>'time','name'=>'start_time','value'=> $row->start_time ? date('H:i', strtotime($row->start_time)) : null,
        'attributes'=>['class'=>'form-control timepicker','col-class'=>"col-md-6",'label'=>trans('courses.Session start time'),'placeholder'=>trans('courses.Session start time'),'required'=>'required','disabled'=> $disabled]])

        @include('form.input',['type'=>'time','name'=>'end_time','value'=> $row->end_time ? date('H:i', strtotime($row->end_time)) : null,
        'attributes'=>['class'=>'form-control timepicker','col-class'=>"col-md-6",'label'=>trans('courses.Session end time'),'placeholder'=>trans('courses.Session end time'),'required'=>'required','disabled'=> $disabled]])
