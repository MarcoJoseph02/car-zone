@extends('layouts.admin_layout')
@push('title')
    {{ @$page_title }}
@endpush
@section('title', @$page_title)
@section('content')
    <div class="row">
        @if(!$rows->isEmpty())
            <div class="card mt-3 pt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ trans('users.user_List') }}</h5>
                    <div>
                        <a href="{{ route('admin.users.create') }}"
                           class="btn btn-primary">{{ trans('users.Create') }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0 w-99">
                            <thead class="thead-light">
                            <tr>
                                <th class="text-center">{{ trans('First name') }}</th>
                                <th class="text-center">{{ trans('Last name') }}</th>
                                <th class="text-center">{{ trans('Email') }}</th>
                                <th class="text-center">{{ trans('phone number') }}</th>
                                <th class="text-center">{{ trans('address') }}</th>
                                <th class="text-center">{{ trans('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0">{{ $row->fname }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0">{{ $row->lname }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0">{{ $row->email }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0">{{ $row->phone_no }}</p>
                                    </td>
                                    <td dir="ltr" class="align-middle text-center text-sm">
                                        <h6 class="text-xs font-weight-bold mb-0">{{ $row->address }}</h6>
                                    </td>

                                   


                                    <td class="align-middle text-center pt-5">
                                        <div class="row">
                                            <div class="col-md-2 col-sm-2 col-xs-2 form-group">
{{--                                                <a class="btn btn-xs btn-primary"--}}
{{--                                                   href="{{  route('admin.users.get.view',$row->id) }}"--}}
{{--                                                   data-bs-toggle="tooltip" data-bs-placement="bottom"--}}
{{--                                                   title="{{ trans('student.view') }}">--}}
{{--                                                    <i class="fa fa-eye"></i>--}}
{{--                                                </a>--}}
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <a class="btn btn-xs btn-primary me-1"
                                                    href="{{ route('admin.users.show', $row->id) }}" title="View">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a class="btn btn-xs btn-info me-1"
                                                    href="{{ route('admin.users.edit', $row->id) }}" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                

                                                {{-- <a class="btn btn-xs btn-danger" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#delete_car_{{ $row->id }}" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </a> --}}
                                            </div>


                                            <div class="col-md-2 col-sm-2 col-xs-2 form-group">
{{--                                                <a class="btn btn-xs btn-success"--}}
{{--                                                   href="{{  route('admin.users.get.logs',$row->id) }}"--}}
{{--                                                   data-bs-toggle="tooltip" data-bs-placement="bottom"--}}
{{--                                                   title="{{ trans('app.Logs') }}">--}}
{{--                                                    <i class="fa fa-bar-chart"></i>--}}
{{--                                                </a>--}}
                                            </div>

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

            <div class="card mt-1 pt-1">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('admin.users.create') }}"
                           class="btn btn-primary">{{ trans('users.Create') }}</a>
                    </div>
                </div>
            </div>
            @include('partials.noData')
        @endif
    </div>
@endsection
