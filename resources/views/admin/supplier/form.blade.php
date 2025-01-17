    @php
        $attributes=['class'=>'form-control','col-class'=>"col-md-12",];

        $fnameAttr = array_merge($attributes , ['label'=>"First Name",'placeholder'=> "First Name"]);
        $lnameAttr = array_merge($attributes , ['label'=>"Last name",'placeholder'=> "Last name"]);
        $phone_noAttr = array_merge($attributes , ['label'=>"Phone Number",'placeholder'=> "Phone Number"]);
        $addressAttr = array_merge($attributes , ['label'=>"Address",'placeholder'=> "Address"]);

    @endphp
    @include('form.input',['type'=>'text','name'=> 'fname','value'=> $row->fname ?? null,'attributes'=>$fnameAttr])
    @include('form.input',['type'=>'text','name'=> 'lname','value'=> $row->lname ?? null,'attributes'=>$lnameAttr])
    @include('form.input',['type'=>'text','name'=> 'phone_no','value'=> $row->phone_no ?? null,'attributes'=>$phone_noAttr])
    @include('form.input',['type'=>'text','name'=> 'address','value'=> $row->address ?? null,'attributes'=>$addressAttr])


