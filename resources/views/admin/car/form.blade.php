    {{-- @php
        $attributes=['class'=>'form-control','col-class'=>"col-md-12"];
        $model_attributes = array_merge($attributes , ['label'=>"Model",'placeholder'=> "Model"]);
        $year_attributes = array_merge($attributes , ['label'=>"Year",'placeholder'=> "Year"]);
        $price_attributes = array_merge($attributes , ['label'=>"Price",'placeholder'=> "Price"]);
        $description_attributes = array_merge($attributes , ['label'=>"description",'placeholder'=> "description"]);
        $supplier_attributes = array_merge($attributes , ['label'=>"Supplier",'placeholder'=> "Supplier"]);
        $branch_attributes = array_merge($attributes , ['label'=>"Branch",'placeholder'=> "Branch"]);
        $brand_attributes = array_merge($attributes , ['label'=>"Brand",'placeholder'=> "Brand"]);
        $category_attributes = array_merge($attributes , ['label'=>"Category",'placeholder'=> "Category"]);
    @endphp
    @include('form.input',['type'=>'text','name'=> 'model','value'=> $row->model ?? null,'attributes'=>$model_attributes])
    @include('form.input',['type'=>'text','name'=> 'year','value'=> $row->year ?? null,'attributes'=>$year_attributes])
    @include('form.input',['type'=>'text','name'=> 'price','value'=> $row->price ?? null,'attributes'=>$price_attributes])
    @include('form.input',['type'=>'text','name'=> 'description','value'=> $row->description ?? null,'attributes'=>$description_attributes])

    @include('form.select',['name'=>'supplier_id','options'=> $suppliers, 'value'=> $row?->supplier_id ?? null ,'attributes'=>$supplier_attributes])
    @include('form.select',['name'=>'branch_id','options'=> $branches, 'value'=> $row?->branch_id ?? null ,'attributes'=>$branch_attributes])
    @include('form.select',['name'=>'category_id','options'=> $categories, 'value'=> $row?->category_id ?? null ,'attributes'=>$category_attributes])
    @include('form.select',['name'=>'brand_id','options'=> $brands, 'value'=> $row?->brand_id ?? null ,'attributes'=>$brand_attributes])

 --}}


{{-- @php
    $attributes=['class'=>'form-control','col-class'=>"col-md-12"];

    // Text Fields
    $model_attributes = array_merge($attributes , ['label'=>"Model",'placeholder'=> "Model"]);
    $year_attributes = array_merge($attributes , ['label'=>"Year",'placeholder'=> "Year"]);
    $price_attributes = array_merge($attributes , ['label'=>"Price",'placeholder'=> "Price"]);
    $color_attributes = array_merge($attributes , ['label'=>"Color",'placeholder'=> "Color"]);
    $engine_type_attributes = array_merge($attributes , ['label'=>"Engine Type",'placeholder'=> "Engine Type"]);
    $transmission_attributes = array_merge($attributes , ['label'=>"Transmission",'placeholder'=> "Transmission"]);
    
    // Numeric Fields
    $doors_attributes = array_merge($attributes , ['label'=>"Doors",'placeholder'=> "Number of Doors"]);
    $acceleration_attributes = array_merge($attributes , ['label'=>"Acceleration",'placeholder'=> "Acceleration (0-100 km/h)"]);
    $top_speed_attributes = array_merge($attributes , ['label'=>"Top Speed",'placeholder'=> "Top Speed (km/h)"]);
    $fuel_efficiency_attributes = array_merge($attributes , ['label'=>"Fuel Efficiency",'placeholder'=> "Fuel Efficiency (L/100km)"]);
    $engine_power_attributes = array_merge($attributes , ['label'=>"Engine Power",'placeholder'=> "Power (HP)"]);
    $engine_cylinder_attributes = array_merge($attributes , ['label'=>"Engine Cylinder",'placeholder'=> "Cylinder Count"]);
    $engine_cubic_capacity_attributes = array_merge($attributes , ['label'=>"Cubic Capacity",'placeholder'=> "Engine Cubic Capacity (cc)"]);

    // Text Areas
    $features_attributes = array_merge($attributes , ['label'=>"Features",'placeholder'=> "Enter car features"]);
    $performance_attributes = array_merge($attributes , ['label'=>"Performance",'placeholder'=> "Enter performance details"]);
    $safety_attributes = array_merge($attributes , ['label'=>"Safety",'placeholder'=> "Enter safety details"]);

    // Dropdowns
    $supplier_attributes = array_merge($attributes , ['label'=>"Supplier",'placeholder'=> "Select Supplier"]);
    $branch_attributes = array_merge($attributes , ['label'=>"Branch",'placeholder'=> "Select Branch"]);
    $brand_attributes = array_merge($attributes , ['label'=>"Brand",'placeholder'=> "Select Brand"]);
    $category_attributes = array_merge($attributes , ['label'=>"Category",'placeholder'=> "Select Category"]);

    // Boolean Fields (CheckBoxes)
    $is_sold_attributes = array_merge($attributes , ['label'=>"Is Sold"]);
    $is_booked_attributes = array_merge($attributes , ['label'=>"Is Booked"]);

@endphp --}}

{{-- Basic Car Details --}}
{{-- @include('form.input',['type'=>'text','name'=> 'model','value'=> $row->model ?? null,'attributes'=>$model_attributes])
@include('form.input',['type'=>'text','name'=> 'year','value'=> $row->year ?? null,'attributes'=>$year_attributes])
@include('form.input',['type'=>'text','name'=> 'price','value'=> $row->price ?? null,'attributes'=>$price_attributes])
@include('form.input',['type'=>'text','name'=> 'color','value'=> $row->color ?? null,'attributes'=>$color_attributes])
@include('form.input',['type'=>'text','name'=> 'engine_type','value'=> $row->engine_type ?? null,'attributes'=>$engine_type_attributes])
@include('form.input',['type'=>'text','name'=> 'transmission','value'=> $row->transmission ?? null,'attributes'=>$transmission_attributes]) --}}

{{-- Numeric Attributes --}}
{{-- @include('form.input',['type'=>'number','name'=> 'doors','value'=> $row->doors ?? null,'attributes'=>$doors_attributes])
@include('form.input',['type'=>'number','name'=> 'acceleration','value'=> $row->acceleration ?? null,'attributes'=>$acceleration_attributes])
@include('form.input',['type'=>'number','name'=> 'top_speed','value'=> $row->top_speed ?? null,'attributes'=>$top_speed_attributes])
@include('form.input',['type'=>'number','name'=> 'fuel_efficiency','value'=> $row->fuel_efficiency ?? null,'attributes'=>$fuel_efficiency_attributes])
@include('form.input',['type'=>'number','name'=> 'engine_power','value'=> $row->engine_power ?? null,'attributes'=>$engine_power_attributes])
@include('form.input',['type'=>'number','name'=> 'engine_cylinder','value'=> $row->engine_cylinder ?? null,'attributes'=>$engine_cylinder_attributes])
@include('form.input',['type'=>'number','name'=> 'engine_cubic_capacity_type','value'=> $row->engine_cubic_capacity_type ?? null,'attributes'=>$engine_cubic_capacity_attributes]) --}}

{{-- Text Area Fields --}}
{{-- @include('form.textarea',['name'=> 'features','value'=> $row->features ?? null,'attributes'=>$features_attributes])
@include('form.textarea',['name'=> 'performance','value'=> $row->performance ?? null,'attributes'=>$performance_attributes])
@include('form.textarea',['name'=> 'safety','value'=> $row->safety ?? null,'attributes'=>$safety_attributes]) --}}

{{-- Dropdowns --}}
{{-- @include('form.select',['name'=>'supplier_id','options'=> $suppliers, 'value'=> $row?->supplier_id ?? null ,'attributes'=>$supplier_attributes])
@include('form.select',['name'=>'branch_id','options'=> $branches, 'value'=> $row?->branch_id ?? null ,'attributes'=>$branch_attributes])
@include('form.select',['name'=>'category_id','options'=> $categories, 'value'=> $row?->category_id ?? null ,'attributes'=>$category_attributes])
@include('form.select',['name'=>'brand_id','options'=> $brands, 'value'=> $row?->brand_id ?? null ,'attributes'=>$brand_attributes]) --}}

{{-- Boolean Fields --}}
{{-- @include('form.checkbox',['name'=>'is_sold','value'=> $row->is_sold ?? false,'attributes'=>$is_sold_attributes])
@include('form.checkbox',['name'=>'is_booked','value'=> $row->is_booked ?? false,'attributes'=>$is_booked_attributes]) --}}



@php
    $attributes = ['class' => 'form-control', 'col-class' => "col-md-12"];
    
    $fields = [
        'model' => ['label' => "Model", 'placeholder' => "Enter Model", 'type' => 'text'],
        'year' => ['label' => "Year", 'placeholder' => "Enter Year", 'type' => 'number'],
        'price' => ['label' => "Price", 'placeholder' => "Enter Price", 'type' => 'number'],
        'color' => ['label' => "Color", 'placeholder' => "Enter Color", 'type' => 'text'],
        'doors' => ['label' => "Doors", 'placeholder' => "Enter Number of Doors", 'type' => 'number'],
        'acceleration' => ['label' => "Acceleration (0-100 km/h)", 'placeholder' => "Enter Acceleration", 'type' => 'number'],
        'top_speed' => ['label' => "Top Speed (km/h)", 'placeholder' => "Enter Top Speed", 'type' => 'number'],
        'fuel_efficiency' => ['label' => "Fuel Efficiency (L/100km)", 'placeholder' => "Enter Fuel Efficiency", 'type' => 'number'],
        'engine_type' => ['label' => "Engine Type", 'placeholder' => "Enter Engine Type", 'type' => 'text'],
        'engine_power' => ['label' => "Engine Power (HP)", 'placeholder' => "Enter Engine Power", 'type' => 'number'],
        'engine_cylinder' => ['label' => "Engine Cylinder", 'placeholder' => "Enter Engine Cylinder", 'type' => 'number'],
        'engine_cubic_capacity_type' => ['label' => "Engine Cubic Capacity", 'placeholder' => "Enter Engine Cubic Capacity", 'type' => 'number'],
        'transmission' => ['label' => "Transmission", 'placeholder' => "Enter Transmission Type", 'type' => 'text'],
        'features' => ['label' => "Features", 'placeholder' => "Enter Features", 'type' => 'textarea'],
        'performance' => ['label' => "Performance", 'placeholder' => "Enter Performance Details", 'type' => 'textarea'],
        'safety' => ['label' => "Safety", 'placeholder' => "Enter Safety Features", 'type' => 'textarea'],
        
    ];

    $selectFields = [
        'supplier_id' => ['label' => "Supplier", 'options' => $suppliers],
        'category_id' => ['label' => "Category", 'options' => $categories],
        'brand_id' => ['label' => "Brand", 'options' => $brands],
        'branch_id' => ['label' => "Branch", 'options' => $branches],
    ];

    
@endphp


@foreach($fields as $name => $details)
    @include('form.input', [
        'type' => $details['type'],
        'name' => $name,
        'value' => $row->$name ?? null,
        'attributes' => array_merge($attributes, [
            'label' => $details['label'],
            'placeholder' => $details['placeholder']
        ])
    ])
@endforeach

@foreach($selectFields as $name => $details)
    @include('form.select', [
        'name' => $name,
        'options' => $details['options'],
        'value' => $row->$name ?? null,
        'attributes' => array_merge($attributes, [
            'label' => $details['label']
        ])
    ])
@endforeach


{{-- <input type="file" id="files" name="files" multiple><br><br> --}}
{{-- <input type="file" id="images" name="images[]" accept="image/*" multiple><br><br> --}}

{{-- @include('form.file',[
    'name'=>'images[]',
    'attributes'=>func($attributes[])
    ]) --}}

    {{-- add in an array  or use array_merge()  --}}
    {{-- 2nd --}}

    @php
    $imageAttributes = [
        'class' => 'form-control',
        'col-class' => "col-md-12",
        'label' => "Car Main Image",
    ];
@endphp

@include('form.file', [
    'name' => 'main',
    'value' => null, // File inputs don't keep values for security reasons
    'attributes' => $imageAttributes
])



    @php
    $imageAttributes = [
        'class' => 'form-control',
        'col-class' => "col-md-12",
        'label' => "Car gallery",
        'multiple'=> "multiple"
    ];
@endphp

@include('form.file', [
    'name' => 'gallery[]',
    'value' => null, // File inputs don't keep values for security reasons
    'attributes' => $imageAttributes
])
