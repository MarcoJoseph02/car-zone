@php
    $attributes=['id'=>'picture','class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('users.Picture') . ' (' . trans('courses.image diminssion') . ')'. ' (' . trans('courses.image_discription') . ')','placeholder'=>trans('users.Picture'), 'required' => $row->id ? false : true, 'accept'=>'image/png, image/jpg, image/jpeg'];
@endphp
@include('form.file',['name'=>'picture', 'value'=>$row->picture ?? null ,'attributes'=>$attributes])

@php
    $attributes=['id'=>'medium_picture','class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('courses.medium_picture') . ' (' . trans('courses.image medium diminssion') . ')'. ' (' . trans('courses.image_medium_discription') . ')','placeholder'=>trans('users.Picture'), 'required' => $row->id ? false : true, 'accept'=>'image/png, image/jpg, image/jpeg'];
@endphp
@include('form.file',['name'=>'medium_picture', 'value'=>$row->medium_picture ?? null ,'attributes'=>$attributes])
@php
    $attributes=['id'=>'small_picture','class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('courses.small_picture') . ' (' . trans('courses.image small diminssion') . ')','placeholder'=>trans('users.Picture'), 'required' => $row->id ? false : true, 'accept'=>'image/png, image/jpg, image/jpeg'];
@endphp
@include('form.file',['name'=>'small_picture', 'value'=>$row->small_picture ?? null ,'attributes'=>$attributes])

@php
    $attributes=[
        'id'=>'preview_media',
        'class'=>'form-control',
        'col-class'=>"col-md-6",
        'label'=>trans('courses.preview_media') . ' (' . trans('courses.video_size') . ')' . ' (' . trans('courses.available_formats') . ')',
        'placeholder'=>trans('courses.preview_media'),
        "accept"=>"video/mp4,video/x-m4v,video/*"];
@endphp
@include('form.file-video',['name'=>'preview_media', 'value'=>$row->preview_media ?? null ,'attributes'=>$attributes])
