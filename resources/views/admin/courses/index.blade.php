@extends('layouts.admin_layout')
@push('title')
    {{ @$page_title }}
@endpush
@section('title', @$page_title)
@section('content')
    <div class="row">
        @include('admin.courses._filter')
        @if(!$rows->isEmpty())
            <div class="card pt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ trans('courses.courses List') }}</h5>
                    <div>
                        <a href="{{ route('admin.courses.get.create') }}"
                           class="btn btn-primary">{{ trans('courses.Create') }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0 w-99">
                            <thead>
                            <tr>
                                <th class="text-center">{{ trans('courses.Name') }}</th>
                                <th class="text-center">{{ trans('courses.School') }}</th>
                                <th class="text-center">{{ trans('courses.Max Allowed Students') }}</th>
                                <th class="text-center">{{ trans('courses.views_count') }}</th>
                                <th class="text-center">{{ trans('courses.subscribers_count') }}</th>
                                <th class="text-center">{{ trans('courses.Is active') }}</th>
                                <th class="text-center">{{ trans('courses.created on') }}</th>
                                <th class="text-center">{{ trans('courses.Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr>
                                    <td class="align-middle text-center pt-3 text-sm">
                                        <p class="text-xs font-weight-bold mb-0">{{ wordwrap($row->name,100) }}</p>
                                    </td>
                                    @if($row->schools->isEmpty())
                                        <td class="align-middle text-center pt-3 text-sm">
                                            <p class="text-xs font-weight-bold mb-0">-</p>
                                        </td>
                                    @else
                                        <td class="align-middle text-center pt-3 text-sm">
                                            {{ $row->schools->first()?->name}}
                                        </td>
                                    @endif
                                    <td class="align-middle text-center pt-3">
                                        <h6 class="text-xs font-weight-bold mb-0">{{ @$row->max_allowed_students }}</h6>
                                    </td>
                                    <td class="align-middle text-center pt-3">
                                        <h6 class="text-xs font-weight-bold mb-0">{{  @$row->visits->count() ?? '0' }}</h6>
                                    </td>
                                    <td class="align-middle text-center pt-3"> {{@$row->students->count() ?? '0'}}</td>
                                    <td class="align-middle text-center pt-3 text-sm">
                                        {!! $row->is_active ? '<span class="badge badge-sm badge-primary">'.trans('users.active') : '<span
                                    class="badge badge-sm badge-danger">'.trans('users.not active') !!}
                                    </td>
                                    <td class="align-middle text-center pt-3">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $row->created_at }}</span>
                                    </td>
                                    <td class="align-middle text-center pt-5">
                                        <div class="row">
                                            <div class="col-md-2 col-sm-2 col-xs-2 " data-step="2"
                                                 data-intro="{{trans('introJs.You Can View Courses!')}}"
                                                 data-position='right'>
                                                <div class="col-md-3 col-sm-3 col-xs-3 form-group">
                                                    <a class="btn btn-xs btn-primary"
                                                       href="{{  route('admin.courses.get.view',$row->id) }}"
                                                       data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                       title="{{ trans('course.view') }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-sm-2 col-xs-2 " data-step="3"
                                                 data-intro="{{trans('introJs.Get sessions of Courses!')}}"
                                                 data-position='right'>
                                                <div class="col-md-3 col-sm-3 col-xs-3 form-group">
                                                    <a class="btn btn-xs btn-dark"
                                                       href="{{  route('admin.courses.get.course.sessions',$row->id) }}"
                                                       data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                       title="{{ trans('course.sessions') }}">
                                                        <i class="fa fa-tasks"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-sm-1 col-xs-1" data-position='right'>
                                                <div class="form-group text-center">
                                                    <a class="btn btn-xs {{ $row->is_on_landing_page ? 'btn-danger' : 'btn-primary' }}
                                                       href="#"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#toggle_landing_page_{{ $row->id }}"
                                                    title="{{ $row->is_on_landing_page ? trans('courses.remove_subscribe_action') : trans('courses.add_subscribe_action') }}">
                                                    <i class="{{ $row->is_on_landing_page ? 'fa fa-remove' : 'fa fa-plus' }}"></i>
                                                    </a>
                                                </div>

                                                <!-- Modal -->
                                                <div class="modal fade" id="toggle_landing_page_{{ $row->id }}"
                                                     tabindex="-1" role="dialog"
                                                     aria-labelledby="toggleLandingPageModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <form method="POST"
                                                                      action="{{ route('admin.courses.toggle-landing-page', $row->id) }}">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label>
                                                                            {{ $row->is_on_landing_page
                                                                                ? trans('courses.Are you sure you want to remove subscribe button from this course?')
                                                                                : trans('courses.Are you sure you want to add subscribe button to this course?') }}
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-group mt-3 text-center">
                                                                        <button type="submit" class="btn btn-primary">
                                                                            {{ trans('app.confirm') }}
                                                                        </button>
                                                                        <button type="button" class="btn btn-danger"
                                                                                data-bs-dismiss="modal">
                                                                            {{ trans('app.cancel') }}
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-1 col-sm-1 col-xs-1 " data-step="4"
                                                 data-intro="{{trans('introJs.You Can Edit Courses!')}}"
                                                 data-position='right'>
                                                <div class="col-md-3 col-sm-3 col-xs-3 form-group">
                                                    <a class="btn btn-xs btn-info"
                                                       href="{{  route('admin.courses.get.edit',[$row->id, 'BasicInfo']) }}"
                                                       data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                       title="{{ trans('course.edit') }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-sm-2 col-xs-2">
                                                <a class="btn btn-xs btn-success"
                                                   href="{{ route('admin.courses.get.subscribers', $row->id) }}"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="bottom"
                                                   title="{{ trans('courses.subscribers') }}">
                                                    <i class="fa fa-users"></i>
                                                </a>
                                            </div>
                                        </div>


                                        <div class="col-md-1 col-sm-1 col-xs-1 " data-position='right'>
                                            <div class="form-group" style="align:center">
                                                <a
                                                        class="btn btn-xs btn-dark  @if(!$row->is_active) disabled @endif"
                                                        href="#"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#cancel_course_{{$row->id}}"
                                                        title="{{ trans('app.cancel') }}">
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                            </div>
                                            <div
                                                    class="modal fade"
                                                    id="cancel_course_{{$row->id}}"
                                                    tabindex="-1"
                                                    role="dialog"
                                                    aria-labelledby="myModalLabel"
                                                    aria-hidden="true"
                                            >
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <form method="GET" class="d-inline"
                                                                  action="{{route('admin.courses.get.cancel',$row->id)}}">
                                                                {{ csrf_field() }}
                                                                <div class="form-group" style="">
                                                                    <label>{{trans('course.Are you sure you want to cancel this course?')}}
                                                                    </label>
                                                                </div>
                                                                <div class="form-group" style="margin-top: 20px">
                                                                    <button type="submit"
                                                                            class="btn btn-primary">{{ trans('app.confirm') }}</button>
                                                                    <button type="button" class="btn btn-danger"
                                                                            data-bs-dismiss="modal">{{trans('app.cancel')}}</button>

                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        {{--                                            <div class="col-md-1 col-sm-1 col-xs-1 " data-position='right'>--}}
                        {{--                                                <div class="form-group" style="align:center">--}}
                        {{--                                                    <a--}}
                        {{--                                                            class="btn btn-xs btn-danger"--}}
                        {{--                                                            href="#"--}}
                        {{--                                                            data-bs-toggle="modal"--}}
                        {{--                                                            data-bs-target="#delete_course_{{$row->id}}"--}}
                        {{--                                                            title="{{ trans('app.delete') }}">--}}
                        {{--                                                        <i class="fa fa-trash"></i>--}}
                        {{--                                                    </a>--}}
                        {{--                                                </div>--}}
                        {{--                                                <div--}}
                        {{--                                                        class="modal fade"--}}
                        {{--                                                        id="delete_course_{{$row->id}}"--}}
                        {{--                                                        tabindex="-1"--}}
                        {{--                                                        role="dialog"--}}
                        {{--                                                        aria-labelledby="myModalLabel"--}}
                        {{--                                                        aria-hidden="true"--}}
                        {{--                                                >--}}
                        {{--                                                    <div class="modal-dialog modal-dialog-centered" role="document">--}}
                        {{--                                                        <div class="modal-content">--}}
                        {{--                                                            <div class="modal-body">--}}
                        {{--                                                                <form method="POST" class="d-inline"--}}
                        {{--                                                                      action="{{route('admin.courses.delete' , $row->id)}}">--}}
                        {{--                                                                    {{ csrf_field() }}--}}
                        {{--                                                                    {{ method_field('DELETE') }}--}}
                        {{--                                                                    <div class="form-group" style="">--}}
                        {{--                                                                        <label>{{trans('app.Are you sure you want to delete this item?')}}--}}
                        {{--                                                                        </label>--}}
                        {{--                                                                    </div>--}}
                        {{--                                                                    <div class="form-group" style="margin-top: 20px">--}}
                        {{--                                                                        <button type="submit"--}}
                        {{--                                                                                class="btn btn-primary">{{ trans('app.confirm') }}</button>--}}
                        {{--                                                                        <button type="button" class="btn btn-danger"--}}
                        {{--                                                                                data-bs-dismiss="modal">{{trans('app.cancel')}}</button>--}}

                        {{--                                                                    </div>--}}

                        {{--                                                                </form>--}}
                        {{--                                                            </div>--}}
                        {{--                                                        </div>--}}
                        {{--                                                    </div>--}}
                        {{--                                                </div>--}}
                        {{--                                            </div>--}}
                    </div>
                    </td>

                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    {{ $rows->links() }}
                </div>
            </div>
    </div>
    @else
        <div class="card pt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ route('admin.courses.get.create') }}"
                       class="btn btn-primary">{{ trans('courses.Create') }}</a>
                </div>
            </div>
        </div>
        @include('partials.noData')
        @endif
        </div>
        @endsection
