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
                            <h5 class="mb-0">Car Details</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Car Information -->
            <div class="card mt-4">
                <div class="card-body p-3">
                    <table class="table align-items-center mb-0 w-99">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $supplier->id }}</td>
                            </tr>
                            <tr>
                                <th>FIRST NAME</th>
                                <td>{{ $supplier->fname  }}</td>
                            </tr>
                            <tr>
                                <th>LAST NAME</th>
                                <td>{{ $supplier->lname  }}</td>
                            </tr>
                            <tr>
                                <th>PHONE NUMBER</th>
                                <td>{{ $supplier->phone_no }}</td>
                            </tr>
                            <tr>
                                <th>ADDRESS</th>
                                <td>{{ $supplier->address }}</td>
                            </tr>
                            
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
