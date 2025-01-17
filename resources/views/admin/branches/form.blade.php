    @php
        $attributes=['class'=>'form-control','col-class'=>"col-md-12"];
        $phone_no_attributes = array_merge($attributes , ['label'=>"Phone No",'placeholder'=> "Phone No"]);
        $name_attributes = array_merge($attributes , ['label'=>"Name",'placeholder'=> "Name"]);
        $location_attributes = array_merge($attributes , ['label'=>"Location",'placeholder'=> "Location"]);
    @endphp
        
    @include('form.input',['type'=>'text','name'=> 'name','value'=> $row->name ?? null,'attributes'=>$name_attributes])

    @include('form.input',['type'=>'text','name'=> 'phone_no','value'=> $row->phone_no ?? null,'attributes'=>$phone_no_attributes])
    @include('form.input',['type'=>'text','name'=> 'location','value'=> $row->location ?? null,'attributes'=>$location_attributes])


