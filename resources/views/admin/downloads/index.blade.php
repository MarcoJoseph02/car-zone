@extends('layouts.admin_layout')
@push('title')
    {{ @$page_title }}
@endpush
@section('title', @$page_title)
@section('content')
    <div class="row">
        @if(count($inProgressExportTasks) > 0)
            <div class="card pt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ trans('downloads.List_downloads') }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0 w-99">
                            <thead>
                            <tr>
                                <th class="text-center">{{ trans('downloads.file_name') }}</th>
                                <th class="text-center">{{ trans('downloads.extra_data') }}</th>
                                <th class="text-center">{{ trans('downloads.created_at') }}</th>
                                <th class="text-center">{{ trans('downloads.Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-center">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                        <div style="
                      font-size: 25px;
                      width: 100%;
                      text-align: center;
                    ">
                            <div style="margin: 10px">
                                <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
                            </div>
                            <div>
                                <span>{{trans('downloads.your request is processing')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(!$rows->isEmpty())
            <div class="card pt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ trans('downloads.List_downloads') }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0 w-99">
                            <thead>
                            <tr>
                                <th class="text-center"> *</th>
                                <th class="text-center">{{ trans('downloads.file_name') }}</th>
                                <th class="text-center">{{ trans('downloads.extra_data') }}</th>
                                <th class="text-center">{{ trans('downloads.created_at') }}</th>
                                <th class="text-center">{{ trans('downloads.Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr class="text-center">
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->file_name }}</td>
                                    <td>{{ $row->extra_data}}</td>
                                    <td>{{ \Carbon\Carbon::parse($row->created_at)->diffForHumans() }}</td>
                                    <td class="align-middle text-center pt-5">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-3 col-xs-3 form-group">
                                                <a
                                                        target="_blank"
                                                        class="btn btn-xs btn-primary"
                                                        href="{{$row->url}}"
                                                        data-ps-toggle="tooltip"
                                                        data-ps-placement="top"
                                                        title="{{ trans('downloads.download') }}">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-6 col-sm-3 col-xs-3 form-group">
                                                <div class="form-group" style="align:center">
                                                    <a
                                                            class="btn btn-xs btn-danger"
                                                            href="#"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#delete_course_{{$row->id}}"
                                                            title="{{ trans('app.delete') }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                                <div
                                                        class="modal fade"
                                                        id="delete_course_{{$row->id}}"
                                                        tabindex="-1"
                                                        role="dialog"
                                                        aria-labelledby="myModalLabel"
                                                        aria-hidden="true"
                                                >
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <form method="POST" class="d-inline"
                                                                      action="{{route('admin.downloads.delete' , $row->id)}}">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                    <div class="form-group" style="">
                                                                        <label>{{trans('app.Are you sure you want to delete this item?')}}
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
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3 d-flex justify-content-center">
                            {{ $rows->links() }}
                        </div>

                        @else
                            @include('partials.noData')
                        @endif
                    </div>
                </div>
            </div>
@endsection
