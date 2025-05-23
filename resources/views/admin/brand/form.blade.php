    {{-- @php
        $attributes=['class'=>'form-control','col-class'=>"col-md-12",'label'=>"Name",'placeholder'=> "Name"];
    @endphp
    @include('form.input',['type'=>'text','name'=> 'name','value'=> $row->name ?? null,'attributes'=>$attributes])

 --}}


@php
    $attributes = [
        'class' => 'form-control',
        'col-class' => "col-md-12",
        'label' => "Brand Name",
        'placeholder' => "Enter Brand Name"
    ];
@endphp

@include('form.input', [
    'type' => 'text',
    'name' => 'name',
    'value' => $row->name ?? null,
    'attributes' => $attributes
])

@php
    $imageAttributes = [
        'class' => 'form-control',
        'col-class' => "col-md-12",
        'label' => "Brand Image",
    ];
@endphp

@include('form.file', [
    'name' => 'brand_image',
    'value' => null, // File inputs don't keep values for security reasons
    //'value' => $row->brand_image  ?? null,
    'attributes' => $imageAttributes
])
{{-- @if ($row?->getFirstMediaUrl('brand_image'))
    <div class="col-md-12 mt-2">
        <label>Current Image:</label><br>
        <img src="{{ $row->getFirstMediaUrl('brand_image') }}" alt="Brand Image" style="max-width: 150px; max-height: 150px;">
    </div>
@endif --}}