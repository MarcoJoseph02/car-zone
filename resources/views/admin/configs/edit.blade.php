@extends('layouts.admin_layout')

@push('title')
    {{ @$page_title }}
@endpush
@push('css')
    <link rel="stylesheet" type="text/css" href="/assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css"href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
@endpush

@section('title',@$page_title)

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ trans('app.edit') }}</h5>
            </div>
            <div class="card-body">
                <div class="col-md-12 col-sm-12 col-xs-12 x_panel">
                    {{ Form::model($rows,['method' => 'put','class'=>'form-vertical form-label-left']) }}
                    <div class="row">
                        @include('admin.configs.form')
                        <div class="form-group">
                            <div class="form-layout-footer">
                                <button type="submit" class="btn btn-success"> {{ trans('app.Save') }}</button>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="/assets/js/select2.full.min.js"></script>
    <script src="/assets/js/form-select2.min.js"></script>

@endpush