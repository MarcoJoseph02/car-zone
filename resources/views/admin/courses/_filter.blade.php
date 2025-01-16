@push('css')
        <link rel="stylesheet" type="text/css" href="/assets/css/select2.min.css">
@endpush
<div class="card mt-3 pt-3">
    <div class="card-header">
        <h5 class="mb-0">{{ __("courses.filters") }}</h5>
    </div>
    <div class="card-body">
        {!! Form::open(['method' => 'get']) !!}
        <div class="row">
            @include('form.multiselect',['name'=>'courses_filter[]','options'=> $courses , 'value'=>request()->get('courses_filter')?? [] ,
            'attributes'=>['id'=>'courses_filter_id','class'=>'form-control select2','col-class'=>"col-md-6",'label'=>trans('courses.courses')]])
            @include('form.select',['name'=>'instructor_id','options'=> $instructors, 'value'=> request()->get('instructor_id') ?? null ,'attributes'=>['id'=>'instructor_id','class'=>'form-control educational select2','col-class'=>"col-md-6",'label'=>trans('courses.Instructor'),'placeholder'=>trans('courses.Instructor')]])

        </div>
        <div class="row">
            @include('form.input',['type'=>'date','id'=>'end_date','name'=>'creation_date','value'=>request()->get('creation_date') ?? null,
'attributes'=>['class'=>'form-control nowdatepicker','col-class'=>"col-md-6",'label'=>trans('courses.creation_date'),'placeholder'=>trans('courses.creation_date')]])
            @include('form.select',['name'=>'is_active','options'=> [0=>trans('app.inActive'),1=>trans('app.active')], 'value'=> request()->get('is_active') ?? null ,'attributes'=>['id'=>'instructor_id','class'=>'form-control educational select2','col-class'=>"col-md-6",'label'=>trans('courses.status'),'placeholder'=>trans('courses.status')]])

        </div>


        <div class="col-md-12 form-group">
            <button class="btn btn-md btn-primary"><i class="mdi mdi-filter"></i> {{ trans('app.Search') }}
            </button>
            <a class="btn btn-md btn-danger" href="{{url()->current()}}" role="button"><i
                        class="mdi mdi-delete-circle"></i> {{ trans('app.reset') }}</a>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@push('js')
    <script src="/assets/js/select2.full.min.js"></script>
    <script src="/assets/js/form-select2.min.js"></script>
@endpush
