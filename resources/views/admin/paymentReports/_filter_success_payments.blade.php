@push('css')
    <link rel="stylesheet" type="text/css" href="/assets/css/select2.min.css">
@endpush
<div class="card">
    <div class="card-header">
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label-behind">{{ __("payment_transaction.total_students") }}</label>
                    <input type="text" disabled class="form-control" name="to_date"
                           value="{{ $total_students }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label-behind">{{ __("payment_transaction.total_transactions") }}</label>
                    <input type="text" disabled class="form-control" name="to_date"
                           value="{{ $total_transactions }}">
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label-behind">{{ __("payment_transaction.total_deposit") }}</label>
                    <input type="text" disabled class="form-control" name="to_date"
                           value="{{ $total_deposit }}">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        {!! Form::open(['method' => 'get']) !!}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label-behind">{{ __("payment_transaction.from") }}</label>
                    <input type="date" class="form-control" name="from_date"
                           value="{{ old("from_date", request()->get("from_date")) }}"
                           placeholder="{{ __("quiz.date") }}" autocomplete="off">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label-behind">{{ __("payment_transaction.to") }}</label>
                    <input type="date" class="form-control" name="to_date"
                           value="{{ old("to_date", request()->get("to_date")) }}"
                           placeholder="{{ __("quiz.date") }}" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">



            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label-behind">
                        {{ __("users.mobile") }}
                    </label>
                    <input type="text" autocomplete="off" name="mobile"  value="{{ old("mobile", request()->get("mobile")) }}" placeholder="{{ __("users.mobile") }}" class="form-control">
                </div>
            </div>

                @include('form.multiselect',['name'=>'courses_filter[]','options'=> $courses , 'value'=>request()->get('courses_filter')?? [] ,
                    'attributes'=>['id'=>'courses_filter_id','class'=>'form-control select2','col-class'=>"col-md-6",'label'=>trans('courses.courses')]])


        </div>

        <div class="col-md-6 form-group">
            <button class="btn btn-md btn-success"><i class="mdi mdi-filter"></i> {{ trans('app.Search') }}
            </button>
            <a class="btn btn-md btn-success" href="{{url()->current()}}" role="button"><i
                        class="mdi mdi-delete-circle"></i> {{ trans('app.reset') }}</a>
            <a class="@if($rows->isEmpty() || empty(request()->all())) disabled @endif btn btn-md btn-primary"
               href="{{  route('admin.paymentReport.indexExport',['type'=>"success"]+ request()->query())}}">{{ trans('app.Export')}}</a>
            <a class="@if($rows->isEmpty() || empty(request()->all())) disabled @endif btn btn-md btn-warning"
               href="{{  route('admin.paymentReport.indexExport',['type'=>"invoices"]+ request()->query())}}">{{ trans('app.Export Invoices')}}</a>
        </div>

    </div>
    {!! Form::close() !!}
</div>
@push('js')
    <script src="/assets/js/select2.full.min.js"></script>
    <script src="/assets/js/form-select2.min.js"></script>
@endpush

