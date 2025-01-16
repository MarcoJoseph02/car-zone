
@include('admin/courses/sessionsForm')

@php
    $attributes=['class'=>'custom-control-label','label'=>trans('courses.Is active'),'required'=>1];
@endphp
@include('form.boolean',['name'=>'is_active',$attributes])