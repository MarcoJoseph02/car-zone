@extends('layouts.admin_layout')

@section('title', 'Sell Car')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Book Car - {{ $car->model }}</h5>
            </div>
            <div class="card-body">
                {{-- Thanks in advance bro with a hug Kiss --}}

                <form method="POST" action="{{ route('admin.car.processSell', $car->id) }}">{{-- edit here bro do not forget to handel deposit amount --}}
                    @csrf
                    <div class="form-group">
                        <label for="user_id">Select User</label>
                        <select name="user_id" id="user_id" class="form-control">
                            <option value="">-- Choose User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-success">Confirm Booking</button>
                        <a href="{{ route('admin.car.index') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
