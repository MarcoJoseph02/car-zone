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
                    <h5 class="mb-0">Suppliers</h5>
                    <div>
                        <a href="{{ route('admin.supplier.create') }}"
                           class="btn btn-success">Create</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0 w-99">
                            <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Phone Number</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr class="text-center">
                                    <td>{{ $row->fname . $row->lname }}</td>
                                    <td>{{ $row->phone_no }}</td>
                                    <td>{{ $row->address }}</td>
                                    <td class="align-middle text-center pt-5">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-4 form-group">
                                                <a class="btn btn-xs btn-primary"
                                                   href="{{  route('admin.supplier.show',$row->id) }}"
                                                   data-ps-toggle="tooltip"
                                                   data-ps-placement="top" title="View">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4 form-group">
                                                <a class="btn btn-xs btn-info"
                                                   href="{{  route('admin.supplier.edit',$row->id) }}"
                                                   data-ps-toggle="tooltip"
                                                   data-ps-placement="top" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4 form-group">
                                                <div class="form-group" style="align:center">
                                                    <a
                                                            class="btn btn-xs btn-danger"
                                                            href="#"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#delete_course_{{$row->id}}"
                                                            title="Delete">
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
                                                                      action="{{route('admin.supplier.destroy' , $row->id)}}">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                    <div class="form-group" style="">
                                                                        <label>Are you sure you want to delete this item?
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-group" style="margin-top: 20px">
                                                                        <button type="submit"
                                                                                class="btn btn-primary">Confirm</button>
                                                                        <button type="button" class="btn btn-danger"
                                                                                data-bs-dismiss="modal">Cancel</button>

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
                        <div class="pull-right">
                            {{ $rows->links() }}
                        </div>
                        @else
                            <div class="card mt-3 pt-3">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Suppliers</h5>
                                    <div>
                                        <a href="{{ route('admin.supplier.create') }}"
                                           class="btn btn-success">Create</a>
                                    </div>
                                </div>
                            </div>
                            @include('partials.noData')
                        @endif
                    </div>
                </div>
            </div>
    </div>
@endsection
