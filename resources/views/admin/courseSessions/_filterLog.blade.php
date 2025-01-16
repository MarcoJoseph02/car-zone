@push('css')
    <link rel="stylesheet" type="text/css" href="/assets/css/select2.min.css">
@endpush

<div class="card mt-3 filter-form">
    <div class="card-header">
        <h5 class="mb-0 text-muted">{{ __("vcr.filters") }}</h5>
    </div>
    <div class="card-body">
        {!! Form::open(['method' => 'get']) !!}
        <div class="row">
            @include('form.input', ['name' => 'name','type' => 'text', 'value'=>request()->get('name') ?? null, 'attributes'=>[
            'label'=>trans('vcr.name'),'placeholder'=>trans('vcr.name'),
            'id'=>'name','class'=>'form-control','col-class'=>"col-md-6"]])
            @include('form.select',['name'=>'action','options'=> $actions , 'value'=>request()->get('action')  ,
            'attributes'=>['id'=>'action','class'=>'form-control select2','col-class'=>"col-md-6",'label'=>trans('vcr.action'),'placeholder'=>trans('vcr.action')]])
        </div>

        <div class="d-flex justify-content-between">
            <div>
                <button type="submit" class="btn btn-md btn-primary">
                    <i class="mdi mdi-filter"></i> {{ trans('app.Search') }}
                </button>
                <a href="{{ url()->current() }}" class="btn btn-md btn-danger">
                    <i class="mdi mdi-delete-circle"></i> {{ trans('app.reset') }}
                </a>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="/assets/js/select2.full.min.js"></script>
    <script src="/assets/js/form-select2.min.js"></script>
@endpush
