
@php
    $attributes=[
        'class'=>'is_specific_school',
        'label'=>trans('courses.course_type'),
        'stared'=>1
                ];
      $options=[
          ['label'=>trans('courses.General Course'),'value'=>\App\Modules\Courses\Enums\CourseEnums::GENERAL_COURSE],
          ['label'=>trans('courses.Specific School'),'value'=>\App\Modules\Courses\Enums\CourseEnums::SPECIFIC_SCHOOL]
     ]
@endphp
@include('form.radio',['name'=>'is_specific_school',$attributes,$options])

@include('form.select',['name'=>'school_id','options'=> $schools ,'value' => old('school_id', $selectedSchool->id ?? null),
'attributes'=>['id'=>'school_id','class'=>'form-control select2 ','col-class'=>"col-md-6",'label'=>trans('courses.School'),'placeholder'=>trans('courses.School')]])

@include('form.input',['type'=>'text','name'=>'name','value'=> $row->name ?? null,
'attributes'=>['class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('courses.name'),'placeholder'=>trans('courses.name'),'stared'=>1]])

@include('form.input',['type'=>'text','name'=>'description','value'=> $row->description ?? null,
'attributes'=>['class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('courses.description'),'placeholder'=>trans('courses.description'),'stared'=>1]])

@include('form.input',['type'=>'textarea','name'=>'what_we_will_learn','value'=> $row->what_we_will_learn ?? null,
'attributes'=>['class'=>'form-control','col-class'=>"col-md-12",'label'=>trans('courses.what_we_will_learn') . ' (' . trans('courses.what_hint')  . ')','placeholder'=>trans('courses.what_we_will_learn')]])

@include('form.input',['type'=>'number','name'=>'subscription_cost','value'=> $row->subscription_cost ?? null,
'attributes'=>['min'=>0,'class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('courses.Subscription Cost'),'step'=>'any','placeholder'=>trans('courses.Subscription Cost'),'stared'=>1]])



@include('form.input',['type'=>'number','name'=>'max_allowed_students','value'=> $row->max_allowed_students ?? null,
'attributes'=>['min'=>1,'max'=>\App\Modules\Courses\Enums\CourseEnums::MAX_COURSE_SUBSCRIBERS_COUNT,
'class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('courses.Max Allowed Students'),'placeholder'=>trans('courses.Max Allowed Students'),
'stared'=>1]])

@include('form.input',['type'=>'date','id'=>'start_date','name'=>'start_date','value'=> $row->start_date ?? null,
'attributes'=>['class'=>'form-control nowdatepicker','col-class'=>"col-md-6",'label'=>trans('courses.Start Date'),'placeholder'=>trans('courses.Start Date'),'stared'=>1]])

@include('form.input',['type'=>'date','id'=>'end_date','name'=>'end_date','value'=> $row->end_date ?? null,
'attributes'=>['class'=>'form-control nowdatepicker','col-class'=>"col-md-6",'label'=>trans('courses.End Date'),'placeholder'=>trans('courses.End Date'),'stared'=>1]])
@include('form.select',['name'=>'instructor_id','options'=>$instructors , 'value'=> $row->instructor_id ?? 'null' ,
'attributes'=>['id'=>'instructor_id','class'=>'form-control select2','col-class'=>"col-md-6",'label'=>trans('courses.Instructor'),'placeholder'=>trans('courses.Instructor')]])
@include('form.input',['type'=>'text','name'=>'telegram_id','value'=> $row->telegram_id ?? null,
'attributes'=>['class'=>'form-control','col-class'=>"col-md-6",'label'=>trans('courses.telegram_id'),'placeholder'=>trans('courses.telegram_id')]])

@if($row->id)
    @php
        $attributes=['class'=>'custom-control-label','label'=>trans('courses.Is active'),'stared'=>1];
    @endphp
    @include('form.boolean',['name'=>'is_active',$attributes])
@endif

@push('js')

    <script>
        let instructorId = $('#instructor_id');
        $(document).ready(function () {
            $.get('{{ route('admin.users.get.instructors') }}',
                {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                })
                .done(function (response) {
                    @if(!isset($row->instructor_id))
                    $('#instructor_id option').remove();
                    @endif
                    let options = '<option selected="selected" value=""> {{ trans('courses.Instructor') }} </option>';
                    for (let d in response.instructors) {
                        let selected = d === "{{$row->instructor_id}}" ? "selected" : ""
                        options += buildSelectOption(d, response.instructors[d], selected) + '\n';
                    }
                    instructorId.html(options);
                });

        });
        $(document).ready(function () {
            let courseType = $('input[name="is_specific_school"]'); // Access the course type radio buttons
            let schoolSelect = $('#school_id'); // Access the school select dropdown

            // Function to toggle the visibility of the school select
            function toggleSchoolSelect() {
                let selectedType = $('input[name="is_specific_school"]:checked').val();

                if (!selectedType) {
                    $('input[name="is_specific_school"][value="{{ \App\Modules\Courses\Enums\CourseEnums::GENERAL_COURSE }}"]').prop('checked', true);
                    selectedType = "{{ \App\Modules\Courses\Enums\CourseEnums::GENERAL_COURSE }}";
                }

                if (selectedType === "{{ \App\Modules\Courses\Enums\CourseEnums::GENERAL_COURSE }}") {
                    schoolSelect.closest('.form-group').hide(); // Hide school select for "General Course"
                } else {
                    schoolSelect.closest('.form-group').show(); // Show school select for "Specific School"
                }
            }

            // Initial call to set visibility on page load
            toggleSchoolSelect();

            // Trigger visibility logic on course type change
            courseType.on('change', function () {
                toggleSchoolSelect();
            });
        });
        function buildSelectOption(key, value, selected) {
            return "<option value='" + key + "'" + selected + ">" + value + "</option>";
        }
    </script>
@endpush
