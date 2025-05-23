{{-- @extends('layouts.admin_layout')
@push('title')
    {{ @$page_title }}
@endpush
@section('title', @$page_title)
@section('content')
    <div class="row">

        @if (!$rows->isEmpty())
            <div class="card mt-3 pt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">cars</h5>
                    <div>
                        <a href="{{ route('admin.car.create') }}"
                           class="btn btn-success">Create</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0 w-99">
                            <thead>
                            <tr>
                                <th class="text-center">Supplier</th>
                                <th class="text-center">Model</th>
                                <th class="text-center">year</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($rows as $row)
                                <tr class="text-center">
                                    <td>{{ $row->supplier->lname ?? ''}}</td>
                                    <td>{{ $row->model ?? ''}}</td>
                                    <td>{{ $row->year ?? ''}}</td>
                                    <td class="align-middle text-center pt-5">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-4 form-group">
                                                <a class="btn btn-xs btn-primary"
                                                   href="{{  route('admin.car.show',$row->id) }}"
                                                   data-ps-toggle="tooltip"
                                                   data-ps-placement="top" title="View">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4 form-group">
                                                <a class="btn btn-xs btn-info"
                                                   href="{{  route('admin.car.edit',$row->id) }}"
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
                                                                      action="{{route('admin.car.destroy' , $row->id)}}">
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
                                    <h5 class="mb-0">cars</h5>
                                    <div>
                                        <a href="{{ route('admin.car.create') }}"
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
@endsection --}}

@extends('layouts.admin_layout')

@push('title')
    {{ @$page_title }}
@endpush

@section('title', @$page_title)

@section('content')
    <div class="row">
        @if (!$rows->isEmpty())
            <div class="card mt-3 pt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Cars</h5>
                    <div>
                        <a href="{{ route('admin.car.create') }}" class="btn btn-success">Create</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0 w-99">
                            <thead>
                                <tr>
                                    <th class="text-center">Supplier</th>
                                    <th class="text-center">Model</th>
                                    <th class="text-center">Year</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Color</th>
                                    <th class="text-center">Engine Power (HP)</th>
                                    <th class="text-center">Top Speed (km/h)</th>
                                    <th class="text-center">Fuel Efficiency (L/100km)</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows as $row)
                                    <tr class="text-center">
                                        <td>{{ $row->supplier->lname ?? 'N/A' }}</td>
                                        <td>{{ $row->model ?? 'N/A' }}</td>
                                        <td>{{ $row->year ?? 'N/A' }}</td>
                                        <td>${{ number_format($row->price, 2) }}</td>
                                        <td>{{ $row->color ?? 'N/A' }}</td>
                                        <td>{{ $row->engine_power ?? 'N/A' }} HP</td>
                                        <td>{{ $row->top_speed ?? 'N/A' }} km/h</td>
                                        <td>{{ $row->fuel_efficiency ?? 'N/A' }} L/100km</td>
                                        <td>
                                            @if ($row->is_sold)
                                                <span class="badge bg-danger">Sold</span>
                                            @elseif($row->is_booked)
                                                <span class="badge bg-warning">Booked</span>
                                            @else
                                                <span class="badge bg-success">Available</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex justify-content-center">
                                                <a class="btn btn-xs btn-primary me-1"
                                                    href="{{ route('admin.car.show', $row->id) }}" title="View">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a class="btn btn-xs btn-info me-1"
                                                    href="{{ route('admin.car.edit', $row->id) }}" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if(! $row->is_sold)
                                                <a class="btn btn-xs btn-info me-1"
                                                    href="{{ route('admin.car.getSellPage', $row->id) }}" title="Book">
                                                    <i class="fas fa-car"></i> <!-- Changed icon -->
                                                </a>
                                                @endif


                                                @if(! $row->is_booked)
                                                <a class="btn btn-xs btn-info me-1"
                                                    href="{{ route('admin.car.getBookPage', $row->id) }}" title="Book">
                                                    <i class="fas fa-book"></i> <!-- Changed icon -->
                                                </a>
                                                @endif
                                                {{-- <i class="fas fa-car"></i> <!-- Simple car icon -->
                                                <i class="fas fa-car-side"></i> <!-- Side view of a car -->
                                                <i class="fas fa-car-alt"></i> <!-- Alternative car design -->
                                                <i class="fas fa-car-battery"></i> <!-- Battery icon for electric cars --> --}}


                                                <a class="btn btn-xs btn-danger" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#delete_car_{{ $row->id }}" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>

                                            <!-- Delete Confirmation Modal -->
                                            <div class="modal fade" id="delete_car_{{ $row->id }}" tabindex="-1"
                                                role="dialog">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center">
                                                            <h5>Are you sure you want to delete this car?</h5>
                                                            <form method="POST"
                                                                action="{{ route('admin.car.destroy', $row->id) }}">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <div class="mt-3">
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
                                            <!-- End Modal -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $rows->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="card mt-3 pt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Cars</h5>
                    <div>
                        <a href="{{ route('admin.car.create') }}" class="btn btn-success">Create</a>
                    </div>
                </div>
            </div>
            @include('partials.noData')
        @endif
    </div>
@endsection
