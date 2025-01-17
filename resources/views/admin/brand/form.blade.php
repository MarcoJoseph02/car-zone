    @php
        $attributes=['class'=>'form-control','col-class'=>"col-md-12",'label'=>"Name",'placeholder'=> "Name"];
    @endphp
    @include('form.input',['type'=>'text','name'=> 'name','value'=> $row->name ?? null,'attributes'=>$attributes])


