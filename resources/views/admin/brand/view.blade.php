@extends('layouts.admin_layout')
@push('title')
    {{ @$page_title }}
@endpush
@section('title', @$page_title)
@section('content')
    <div class="row mb-5">

        <div class="col-lg-12 mt-lg-0 mt-4">
            <!-- Card Profile -->
            <div class="card card-body">
                <div class="row justify-content-center align-items-center">
                    <div class="col-sm-auto col-8 my-auto">
                        <div class="h-100">
                            <h5 class="mb-0">{{ trans('schools.view_school') }}</h5>
                        </div>
                    </div>
                    <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                        <div class="form-check form-switch ms-2">
                            <a href="{{ route('admin.schools.get.edit', $row->id) }}"
                               class="btn btn-success">{{ trans('app.Edit') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card Basic Info -->
            <div class="card mt-4" id="basic-course-info">
                <div class="card-body p-3">
                    <div class="table-responsive">
                    <table class="table align-items-center mb-0 w-99">
                        <thead>
                        <tr>
                            <th class="text-center">{{ trans('schools.national_id_list') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($nationalIds as $nationalId)
                            <tr class="text-center">
                                <td>{{ $nationalId->national_id }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    <!-- End National ID Table -->

                </div>
            </div>
        </div>
    </div>
@endsection
