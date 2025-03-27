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
                            <h5 class="mb-0">User Details</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Information -->
            <div class="card mt-4">
                <div class="card-body p-3">
                    <table class="table align-items-center mb-0 w-99">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $user->id }}</td>
                            </tr>
                            <tr>
                                <th>First Name</th>
                                <td>{{ $user->fname }}</td>
                            </tr>
                            <tr>
                                <th>Last Name</th>
                                <td>{{ $user->lname }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td>{{ $user->phone_no }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $user->address }}</td>
                            </tr>
                            {{-- <tr>
                                <th>Email Verified At</th>
                                <td>
                                    @if($user->email_verified_at)
                                        {{ $user->email_verified_at->format('Y-m-d H:i:s') }}
                                    @else
                                        Not Verified
                                    @endif
                                </td>
                            </tr> --}}
                            <tr>
                                <th>OTP</th>
                                <td>{{ $user->otp ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                            <tr>
                                <th>Updated At</th>
                                <td>{{ $user->updated_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
