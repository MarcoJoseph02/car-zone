@extends('layouts.admin_layout')
@push('title')
    {{ @$page_title }}
@endpush
@section('title', @$page_title)
@section('content')
    <div class="row mb-5">
        <div class="col-lg-3">
            <div class="card position-sticky top-10">
                <ul class="nav flex-column bg-white border-radius-lg p-3">
                    <li class="nav-item pt-2">
                        <a class="nav-link text-body d-flex align-items-center" data-scroll=""
                           href="#basic-course-info">
                            <i class="ni ni-books me-2 text-dark opacity-6"></i>
                            <span class="text-sm">{{__('courses.basic_course_info')}}</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#course-media">
                            <i class="ni ni-atom me-2 text-dark opacity-6"></i>
                            <span class="text-sm">{{__('courses.course_media')}}</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#course-sessions">
                            <i class="ni ni-ui-04 me-2 text-dark opacity-6"></i>
                            <span class="text-sm">{{__('courses.course_sessions')}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-9 mt-lg-0 mt-4">
            <!-- Card Profile -->
            <div class="card card-body" style="margin-top: 20px!important;">
                <div class="row justify-content-center align-items-center">
                    <div class="col-sm-auto col-8 my-auto">
                        <div class="h-100">
                            <h5 class="mb-1 font-weight-bolder">
                                {{ $row->name}}
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                @if($row->schools->isNotEmpty())
                                    {{trans('courses.affiliated_with')}}
                                    ( {{ $row->schools->first()?->name ?? ''}} )
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                        <div class="form-check form-switch ms-2">
                            <a href="{{ route('admin.courses.get.edit',[$row->id, 'BasicInfo']) }}"
                               class="btn btn-primary">{{ trans('app.Edit') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card Basic Info -->
            <div class="card mt-4" id="basic-course-info">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h5>{{__('courses.basic_course_info')}}</h5>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('admin.courses.get.edit',[$row->id, 'BasicInfo']) }}">
                                <i class="fas fa-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                   data-bs-placement="top" title="{{ trans('app.Edit') }}"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <hr class="horizontal gray-light my-4">
                    <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                            <strong class="text-dark">{{ trans('courses.description') }} : </strong>
                            &nbsp; <p class="text-sm">
                                {{ $row->description}}
                            </p>
                        </li>
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                            <strong class="text-dark">{{ trans('courses.what_we_will_learn') }} : </strong>
                            &nbsp; <p class="text-sm">
                                {{ $row->what_we_will_learn}}
                            </p>
                        </li>
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                            <strong class="text-dark">{{ trans('courses.Instructor') }} : </strong>
                            &nbsp; {!!  $row->instructor->first_name ?? '' !!} {!!  $row->instructor->last_name ?? '' !!}
                        </li>
                        <li class="list-group-item border-0 ps-0 text-sm">
                            <strong class="text-dark">{{ trans('courses.Max Allowed Students') }} :</strong>
                            &nbsp; {!!  @$row->max_allowed_students  !!}
                        </li>
                        <li class="list-group-item border-0 ps-0 text-sm">
                            <strong class="text-dark">{{ trans('courses.subscribers_count') }} :</strong>
                            &nbsp; {!!  count($row->students)  !!}
                        </li>
                        <li class="list-group-item border-0 ps-0 text-sm">
                            <strong class="text-dark">{{ trans('courses.views_count') }} :</strong>
                            &nbsp; {!!  count($row->visits)  !!}
                        </li>

                        <li class="list-group-item border-0 ps-0 text-sm">
                            <strong class="text-dark">{{ trans('courses.date_of_creation') }} :</strong>
                            &nbsp; {!!  $row->created_at !!}
                        </li>

                        <li class="list-group-item border-0 ps-0 text-sm">
                            <strong class="text-dark">{{ trans('courses.number_of_sessions') }} :</strong>
                            &nbsp; {!!  count($row->sessions)  !!}
                        </li>
                        <li class="list-group-item border-0 ps-0 text-sm">
                            <strong class="text-dark">{{ trans('courses.Subscription Cost') }} :</strong>
                            &nbsp; {!!  $row->subscription_cost ?? ''  !!} {{config('paymentGateways.currency')}}
                        </li>
                        <li class="list-group-item border-0 ps-0 text-sm">
                            <strong class="text-dark">{{ trans('courses.Start Date') }} :</strong>
                            &nbsp; {!!  $row->start_date !!}
                        </li>
                        <li class="list-group-item border-0 ps-0 text-sm">
                            <strong class="text-dark">{{ trans('courses.End Date') }} :</strong>
                            &nbsp; {!!  $row->end_date !!}
                        </li>
                        <li class="list-group-item border-0 ps-0 text-sm">
                            <strong class="text-dark">{{ trans('courses.telegram_id') }} :</strong>
                            &nbsp; {!!  $row->telegram_id ? 'https://t.me/'. $row->telegram_id : ' '!!}
                        </li>
                        <li class="list-group-item border-0 ps-0 text-sm">
                            <strong class="text-dark">{{ trans('courses.Is active') }} :</strong>
                            &nbsp; {!!  $row->is_active ? '<span class="label label-primary">'.trans('courses.active') : '<span class="label label-danger">'.trans('courses.not active') !!}
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Card Change Password -->
            <div class="card mt-4" id="course-media">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h5>{{__('courses.course_media')}}</h5>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('admin.courses.get.edit',[$row->id, 'Media']) }}">
                                <i class="fas fa-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                   data-bs-placement="top" title="{{ trans('app.Edit') }}"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4 m-auto">
                            <div class="card card-blog card-plain">
                                <div class="position-relative">
                                    <a class="d-block shadow-xl border-radius-xl">
                                        <img src="{{image($row->picture , App\Modules\BaseApp\Enums\S3Enums::LARGE)}}" alt="img-blur-shadow"
                                             class="img-fluid shadow border-radius-xl">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4 m-auto">
                            <div class="card card-blog card-plain">
                                <div class="position-relative">
                                    <a class="d-block shadow-xl border-radius-xl">
                                        <img src="{{image($row->medium_picture , App\Modules\BaseApp\Enums\S3Enums::LARGE)}}" alt="img-blur-shadow"
                                             class="img-fluid shadow border-radius-xl">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4 m-auto">
                            <div class="card card-blog card-plain">
                                <div class="position-relative">
                                    <a class="d-block shadow-xl border-radius-xl">
                                        <img src="{{image($row->small_picture , App\Modules\BaseApp\Enums\S3Enums::LARGE)}}" alt="img-blur-shadow"
                                             class="img-fluid shadow border-radius-xl">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-xl-0 mb-4">
                            <div class="card card-blog card-plain">
                                <div class="position-relative m-auto">
                                    <a class="d-block shadow-xl border-radius-xl">
                                        <video height="215" controls class="shadow border-radius-xl">
                                            <source src="{{image($row->preview_media)}}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card Change Password -->
            <div class="card mt-4" id="course-sessions">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h5 class="mb-0">{{__('courses.course_sessions')}}</h5>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{route('admin.courses.get.course.sessions',  $row->id)}}">
                                <i class="fas fa-arrow-right text-secondary text-sm"></i>
                            </a>
                            @if (now()->toDateString() <= $row->end_date)
                                {{--                                <a href="{{route('admin.courses.get.create.session',  $row->id)}}">--}}
                                {{--                                    <i class="fas fa-plus-circle text-secondary text-sm" data-bs-toggle="tooltip"--}}
                                {{--                                       data-bs-placement="top" title="{{ trans('app.Create') }}"></i>--}}
                                {{--                                </a>--}}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th>
                                    <p class=" text-center mb-0">{{ trans('course_sessions.content') }}</p>
                                </th>
                                <th>
                                    <p class=" text-center mb-0">{{ trans('course_sessions.Date') }}</p>
                                </th>
                                <th>
                                    <p class=" text-center mb-0">{{ trans('course_sessions.Start time') }}</p>
                                </th>
                                <th>
                                    <p class=" text-center mb-0">{{ trans('course_sessions.End time') }}</p>
                                </th>
                                <th>
                                    <p class=" text-center mb-0">{{ trans('course_sessions.Status') }}</p>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($row->sessions as $session)
                                <tr>
                                    <td class="ps-1">
                                        <div class="my-auto">
                                            <span class="text-dark d-block text-center text-sm">{{$session->content}}</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="my-auto">
                                            <span class="text-dark d-block text-center text-sm">{{$session->date}}</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="my-auto">
                                            <span class="text-dark d-block text-center text-sm">{{$session->start_time}}</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="my-auto">
                                            <span class="text-dark d-block text-center text-sm">{{$session->end_time}}</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="my-auto">
                                            @if($session->status == \App\Modules\Courses\Enums\CourseSessionEnums::ACTIVE)
                                                <span class="badge badge-success badge-sm my-auto ms-auto me-3">{{trans('app.active')}}</span>
                                            @else
                                                <span class="badge badge-danger badge-sm my-auto ms-auto me-3">{{trans('app.canceled')}}</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
