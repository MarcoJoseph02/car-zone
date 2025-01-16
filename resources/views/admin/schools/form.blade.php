@foreach(config("translatable.locales") as $lang)
    @php
        $attributes=['class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('schools.name'.'_'.$lang),'placeholder'=> trans('schools.name'.'_'.$lang)];
    @endphp
    @include('form.input',['type'=>'text','name'=>'name:'.$lang,'value'=> $row->name[$lang] ?? null,'attributes'=>$attributes])
@endforeach


<a style="text-decoration: underline ;color: #3a3ae9"
   href="{{url('school-national-ids-sample.xls')}}"> {{trans('schools.sample_file')}}</a>
@php
    $attributes=[
        'id'=>'national_id_file',
        'class'=>'form-control',
        'label'=>trans('schools.national_id_file') ,
        'accept'=>"application/vnd.ms-excel",
         ];
@endphp
@include('form.file',['name'=>'national_id_file' ,'attributes'=>$attributes])


