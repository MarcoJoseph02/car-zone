@extends('layouts.admin_layout')

@push('title')
    {{ @$page_title }}
@endpush

@section('title',@$page_title)

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ trans('course_sessions.edit_course_sessions') }}</h5>
            </div>
            <div class="card-body">
                <div class="col-md-12 col-sm-12 col-xs-12 x_panel">
                    {{ Form::model($row,['method' => 'put','class'=>'form-vertical form-label-left']) }}
                    <div class="row">

                        @include('admin.courseSessions.form')
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
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

