    @php
        $attributes=['class'=>'form-control','col-class'=>"col-md-12"];
        $model_attributes = array_merge($attributes , ['label'=>"Model",'placeholder'=> "Model"]);
        $year_attributes = array_merge($attributes , ['label'=>"Year",'placeholder'=> "Year"]);
        $price_attributes = array_merge($attributes , ['label'=>"Price",'placeholder'=> "Price"]);
        $description_attributes = array_merge($attributes , ['label'=>"description",'placeholder'=> "description"]);
        $supplier_attributes = array_merge($attributes , ['label'=>"Supplier",'placeholder'=> "Supplier"]);
        $branch_attributes = array_merge($attributes , ['label'=>"Branch",'placeholder'=> "Branch"]);
        $brand_attributes = array_merge($attributes , ['label'=>"Supplier",'placeholder'=> "Supplier"]);
        $category_attributes = array_merge($attributes , ['label'=>"Supplier",'placeholder'=> "Supplier"]);
    @endphp
    @include('form.input',['type'=>'text','name'=> 'model','value'=> $row->model ?? null,'attributes'=>$model_attributes])
    @include('form.input',['type'=>'text','name'=> 'year','value'=> $row->year ?? null,'attributes'=>$year_attributes])
    @include('form.input',['type'=>'text','name'=> 'price','value'=> $row->price ?? null,'attributes'=>$price_attributes])
    @include('form.input',['type'=>'text','name'=> 'description','value'=> $row->description ?? null,'attributes'=>$description_attributes])

    @include('form.select',['name'=>'supplier_id','options'=> $suppliers, 'value'=> $row?->supplier_id ?? null ,'attributes'=>$supplier_attributes])
    @include('form.select',['name'=>'branch_id','options'=> $branches, 'value'=> $row?->branch_id ?? null ,'attributes'=>$branch_attributes])
    @include('form.select',['name'=>'category_id','options'=> $categories, 'value'=> $row?->category_id ?? null ,'attributes'=>$category_attributes])
    @include('form.select',['name'=>'brand_id','options'=> $brands, 'value'=> $row?->brand_id ?? null ,'attributes'=>$brand_attributes])


