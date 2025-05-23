    {{-- @php
        $attributes=['class'=>'form-control','col-class'=>"col-md-12"];
        $phone_no_attributes = array_merge($attributes , ['label'=>"Phone No",'placeholder'=> "Phone No"]);
        $name_attributes = array_merge($attributes , ['label'=>"Name",'placeholder'=> "Name"]);
        $location_attributes = array_merge($attributes , ['label'=>"Location",'placeholder'=> "Location"]);
    @endphp
        
    @include('form.input',['type'=>'text','name'=> 'name','value'=> $row->name ?? null,'attributes'=>$name_attributes])

    @include('form.input',['type'=>'text','name'=> 'phone_no','value'=> $row->phone_no ?? null,'attributes'=>$phone_no_attributes])
    @include('form.input',['type'=>'text','name'=> 'location','value'=> $row->location ?? null,'attributes'=>$location_attributes])

 --}}

@php
    $attributes = ['class' => 'form-control', 'col-class' => "col-md-12"];

    $phone_no_attributes = array_merge($attributes, ['label' => "Phone No", 'placeholder' => "Phone No"]);
    $name_attributes = array_merge($attributes, ['label' => "Name", 'placeholder' => "Name"]);
    $location_attributes = array_merge($attributes, ['label' => "Location", 'placeholder' => "Location"]);

    $lat_attributes = array_merge($attributes, ['label' => "Latitude", 'placeholder' => "Latitude"]);
    $lng_attributes = array_merge($attributes, ['label' => "Longitude", 'placeholder' => "Longitude"]);

    $link_attributes = array_merge($attributes, ['label' => "Google Maps Link", 'placeholder' => "https://maps.google.com/..."]);
@endphp

@include('form.input', ['type' => 'text', 'name' => 'name', 'value' => $row->name ?? null, 'attributes' => $name_attributes])

@include('form.input', ['type' => 'text', 'name' => 'phone_no', 'value' => $row->phone_no ?? null, 'attributes' => $phone_no_attributes])

@include('form.input', ['type' => 'text', 'name' => 'latitude', 'value' => $row->latitude ?? 30, 'attributes' => $lat_attributes])

@include('form.input', ['type' => 'text', 'name' => 'longitude', 'value' => $row->longitude ?? 31, 'attributes' => $lng_attributes])

@include('form.input', ['type' => 'text', 'name' => 'link', 'value' => $row->link ?? null, 'attributes' => $link_attributes])
