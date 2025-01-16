@extends('layouts.admin_layout')
@push('title')
    {{ @$page_title }}
@endpush
@section('title', @$page_title)
@section('content')
    <div class="row mb-5">
        <div class="card">
            <!-- Card Profile -->
            <div class="card-header">
                <div class="row justify-content-center align-items-center">
                    <div class="col-sm-auto col-8 my-auto">
                        <div class="h-100">
                            <h5 class="mb-0">{{ trans('course_sessions.view_course_session') }}</h5>
                        </div>
                    </div>
                    @if($row->status == \App\Modules\Courses\Enums\CourseSessionEnums::ACTIVE)
                    <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                        <div class="form-check form-switch ms-2">
                            <a href="{{ route('admin.courseSessions.get.edit',$row->id) }}"
                               class="btn btn-primary">{{ trans('app.Edit') }}</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="card card-body">
                <ul class="list-group">

                    <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                        <strong class="text-dark">{{ trans('course_sessions.Content') }} : </strong>
                        &nbsp; {{ $row->content }}
                    </li>
                    <li class="list-group-item border-0 ps-0 text-sm">
                        <strong class="text-dark">{{ trans('course_sessions.Status') }} :</strong>
                        &nbsp;{!! $row->status ?? '' !!}
                    </li>
                    <li class="list-group-item border-0 ps-0 text-sm">
                        <strong class="text-dark">{{ trans('course_sessions.Date') }} :</strong>
                        &nbsp; {!! $row->date ?? '' !!}
                    </li>
                    <li class="list-group-item border-0 ps-0 text-sm">
                        <strong class="text-dark">{{ trans('course_sessions.Start time') }} :</strong>
                        &nbsp;{!!  $row->start_time !!}
                    </li>
                    <li class="list-group-item border-0 ps-0 text-sm">
                        <strong class="text-dark">{{ trans('course_sessions.End time') }}:</strong>
                        {!!  $row->end_time !!}
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
