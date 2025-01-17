    @php
        $attributes=['class'=>'form-control','col-class'=>"col-md-12",'label'=>"Type",'placeholder'=> "Type"];
    @endphp
    @include('form.input',['type'=>'text','name'=> 'type','value'=> $row->type ?? null,'attributes'=>$attributes])


