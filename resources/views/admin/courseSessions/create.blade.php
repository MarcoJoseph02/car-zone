@extends('layouts.admin_layout')
@push('title')
    {{ @$page_title }}
@endpush

@section('title',@$page_title)

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ trans('course_sessions.create_course_sessions') }}</h5>
            </div>
            <div class="card-body">
                <div class="col-md-12 col-sm-12 col-xs-12 x_panel">
                    {{ Form::model($row, ['method'=>'post','class'=>'form-vertical form-label-left', 'files' => true ]) }}
                    @if (now()->toDateString() > $row->end_date)
                        <p>{{ trans('course_sessions.can not add session') }}</p>
                        <fieldset disabled="disabled">
                            @endif
                            @include('admin.courseSessions.sessionsForm')
                            <div class="form-group">
                                <div class="form-layout-footer">
                                    <button type="submit" class="btn btn-success"> {{ trans('app.Save') }}</button>
                                </div>
                            </div>
                            @if (now()->toDateString() > $row->end_date)
                        </fieldset>
                    @endif
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

<script>

</script>

