@include('form.input',['type'=>'text','name'=>'name','value'=> $row->name ?? null,
'attributes'=>['class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('courses.name'),'placeholder'=>trans('courses.name')]])

@include('form.input',['type'=>'text','name'=>'description','value'=> $row->description ?? null,
'attributes'=>['class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('courses.description'),'placeholder'=>trans('courses.description'),'required'=>'required']])

@include('form.select',['name'=>'type','options'=> $types , $row->type ?? null ,
'attributes'=>['id'=>'type','class'=>'form-control select2','col-class'=>"col-md-6",'label'=>trans('courses.Type'),'placeholder'=>trans('courses.Type'),'required'=>'required' , 'instructors' => json_encode($instructors)]])

@include('form.select',['name'=>'subject_id','options'=> $subjects , $row->subject_id ?? null ,
'attributes'=>['id'=>'subject_id','class'=>'form-control select2','col-class'=>"col-md-6 subject_course_extra_data",'label'=>trans('courses.Subject'),'placeholder'=>trans('courses.Subject')]])

@include('form.select',['name'=>'educational_system_id','options'=> $educationalSystems , 'value'=> $row->educational_system_id ?? null ,
    'attributes'=>['id'=>'educational_system_id','class'=>'form-control educational select2','col-class'=>"col-md-6 public_course_extra_data",'label'=>trans('app.Educational System'),'placeholder'=>trans('app.Educational System')]])

@include('form.select',['name'=>'educational_level_id','options'=> $educational_levels , $row->educational_level_id ?? null ,
    'attributes'=>['id'=>'educational_level_id','class'=>'form-control select2','col-class'=>"col-md-6 public_course_extra_data",'label'=>trans('subjects.Educational Level'),'placeholder'=>trans('subjects.Educational Level')]])

@include('form.select',['name'=>'grade_class_id','options'=> [] , $row->grade_class_id ?? null ,
    'attributes'=>['id'=>'grade_class_id','class'=>'form-control select2','col-class'=>"col-md-6 public_course_extra_data",'label'=>trans('subjects.Grade Class'),'placeholder'=>trans('subjects.Grade Class')]])

@include('form.input',['type'=>'number','name'=>'subscription_cost','value'=> $row->subscription_cost ?? null,
'attributes'=>['class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('courses.Subscription Cost'),'placeholder'=>trans('courses.Subscription Cost'),'required'=>'required']])

@include('form.select',['name'=>'apple_product_id','id'=>'apple_product_id','options'=>$apple_price,'value'=> $row->apple_product_id ?? null,
'attributes'=>['class'=>'form-control select2','col-class'=>"col-md-6",'label'=>trans('courses.Subscription Cost for apple'),'placeholder'=>trans('courses.Subscription Cost for apple'),'required'=>'required']])

@include('form.select',['name'=>'instructor_id','options'=>$instructors , 'value'=> $row->instructor_id ?? 'null' ,
'attributes'=>['id'=>'instructor_id','class'=>'form-control select2','col-class'=>"col-md-6",'label'=>trans('courses.Instructor'),'placeholder'=>trans('courses.Instructor')]])

@include('form.input',['type'=>'number','name'=>'max_allowed_students','value'=> $row->max_allowed_students ?? null,
'attributes'=>['min'=>1,'max'=>\App\OurEdu\Courses\Enums\CourseEnums::MAX_COURSE_SUBSCRIBERS_COUNT,
'class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('courses.Max Allowed Students'),'placeholder'=>trans('courses.Max Allowed Students'),
'required'=>'required']])

@include('form.input',['type'=>'date','name'=>'start_date','value'=> $row->start_date ?? null,
'attributes'=>['class'=>'form-control nowdatepicker','col-class'=>"col-md-6",'label'=>trans('courses.Start Date'),'placeholder'=>trans('courses.Start Date'),'required'=>'required']])

@include('form.input',['type'=>'date','name'=>'end_date','value'=> $row->end_date ?? null,
'attributes'=>['class'=>'form-control nowdatepicker','col-class'=>"col-md-6",'label'=>trans('courses.End Date'),'placeholder'=>trans('courses.End Date'),'required'=>'required']])
@php
    $attributes=['id'=>'picture','class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('users.Picture') . ' (' . trans('courses.image diminssion') . ')','placeholder'=>trans('users.Picture'), 'required' => $row->id ? false : true, 'accept'=>'image/png, image/jpg, image/jpeg'];
@endphp
@include('form.file',['name'=>'picture', 'value'=>$row->picture ?? null ,'attributes'=>$attributes])

@php
    $attributes=['id'=>'medium_picture','class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('courses.medium_picture') . ' (' . trans('courses.image medium diminssion') . ')','placeholder'=>trans('users.Picture'), 'required' => $row->id ? false : true, 'accept'=>'image/png, image/jpg, image/jpeg'];
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
        'label'=>trans('courses.preview_media'),
        'placeholder'=>trans('courses.preview_media'),
        "accept"=>"video/mp4,video/x-m4v,video/*"];
@endphp
@include('form.file-video',['name'=>'preview_media', 'value'=>$row->preview_media ?? null ,'attributes'=>$attributes])
@php
    $attributes=['class'=>'custom-control-label','label'=>trans('courses.Is active'),'required'=>1];
@endphp
@include('form.boolean',['name'=>'is_active',$attributes])
{{--@php--}}
{{--    $attributes=['class'=>'form-control','label'=>trans('courses.Is Top Qudrat'),'required'=>1];--}}
{{--@endphp--}}
{{--@include('form.boolean',['name'=>'is_top_qudrat',$attributes])--}}


@if(! $row->id)
    @include('admin/courses/sessionsForm')
@endif
@push('js')
    <script>
        let publicCourseExtraData = $('.public_course_extra_data')
        let subjectCourseExtraData = $('.subject_course_extra_data')
        let type = $('#type')
        let subjectId = $('#subject_id')
        let educationalSystemId = $("#educational_system_id")
        let educationalLevelId = $('#educational_level_id')
        let gradeClassId = $('#grade_class_id')
        let instructorId = $('#instructor_id')

        $(document).ready(function () {
            publicCourseExtraData.hide();
            if (type.val() === "{{\App\OurEdu\Courses\Enums\CourseEnums::PUBLIC_COURSE}}") {
                publicCourseExtraData.show();
            }

            educationalLevelId.change(function () {
                getGrades(this);
            });

            educationalSystemId.change(function () {
                getEducationalLevels(this);
            });

            if (educationalLevelId.val()) {
                educationalLevelId.trigger('change')
            }
            // on trigger courser type
            // the public and subject courses
            type.on('change', function (e) {
                let type = $(this).val();
                if (type === 'subject_course') {
                    subjectCourseExtraData.show();
                    subjectId.removeProp("selected");
                    educationalSystemId.removeProp("selected");
                    educationalLevelId.removeProp("selected");
                    gradeClassId.removeProp("selected");
                    publicCourseExtraData.hide();
                    instructorId.html('<option selected="selected" value=""> {{ trans('vcr_schedule.Instructor') }} </option>');
                    // get Instructors System by subject id
                    subjectId.on('change', function () {
                        $.get('{{ route('admin.users.get.instructors') }}',
                            {
                                '_token': $('meta[name=csrf-token]').attr('content'),
                                subject_id: this.value,
                            })
                            .done(function (response) {
                                @if(!isset($row->instructor_id))
                                $('#instructor_id option').remove();
                                @endif
                                let options = '<option selected="selected" value=""> {{ trans('vcr_schedule.Instructor') }} </option>';
                                for (let d in response.instructors) {
                                    let selected = d === "{{$row->instructor_id}}" ? "selected" : ""
                                    options += buildSelectOption(d, response.instructors[d], selected) + '\n';
                                }
                                instructorId.html(options);
                            });
                    });
                } else {
                    publicCourseExtraData.show();
                    subjectId.removeProp("selected");
                    subjectCourseExtraData.hide();
                    if (educationalLevelId.val()) {
                        educationalLevelId.trigger('change')
                    }
                    $.get('{{ route('admin.users.get.instructors') }}',
                        {
                            '_token': $('meta[name=csrf-token]').attr('content'),
                        })
                        .done(function (response) {
                            @if(!isset($row->instructor_id))
                            $('#instructor_id option').remove();
                            @endif
                            let options = '<option selected="selected" value=""> {{ trans('vcr_schedule.Instructor') }} </option>';
                            for (let d in response.instructors) {
                                let selected = d === "{{$row->instructor_id}}" ? "selected" : ""
                                options += buildSelectOption(d, response.instructors[d], selected) + '\n';
                            }
                            instructorId.html(options);
                        });
                }
            });

            if (type.val()) {
                type.trigger('change');
            }
            if (subjectId.val()) {
                subjectId.trigger('change');
            }
        });

        function getEducationalLevels(element) {
            let educationalLevel = $('#educational_level_id');
            $.get('{{ route('admin.educationalLevels.get.EducationalLevelByEducationalSystem') }}',
                {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    'educational_system_id': element.value ? element.value : element.val(),
                })
                .done(function (response) {
                    @if(!isset($row->educational_system_id))
                    $('#educational_level_id option').remove();
                    @endif
                    let options = '<option selected="selected" value=""> {{trans('subjects.Educational Level')}} </option>';
                    for (let d in response.educationalLevel) {
                        var selected = {{$relation->educational_level_id?? null}}
                            options += buildSelectOption(d, response.educationalLevel[d], selected == d ? "selected" : '') + '\n';
                    }
                    educationalLevel.html(options);
                    educationalLevel.trigger('change');
                });

        }

        function getGrades(element) {
            $.get('{{ route('admin.gradeClasses.get.by.educational.level') }}',
                {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    'educational_level_id': element.value,
                })
                .done(function (response) {
                    @if(!isset($row->educational_system_id))
                    $('#class_id option').remove();
                    @endif
                    let options = '<option selected="selected" value=""> {{trans('subjects.Grade Class')}} </option>';
                    for (let d in response.gradeClasses) {
                        var selected = {{$row->grade_class_id ?? null}}

                            options += buildSelectOption(d, response.gradeClasses[d], selected == d ? "selected" : '') + '\n';
                    }
                    $('#grade_class_id').html(options);
                });

        }

        function buildSelectOption(key, value, selected) {
            return "<option value='" + key + "'" + selected + ">" + value + "</option>";
        }
    </script>
@endpush
