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
                                <th>Model</th>
                                <td>{{ $car->model }}</td>
                            </tr>
                            <tr>
                                <th>Year</th>
                                <td>{{ $car->year }}</td>
                            </tr>
                            <tr>
                                <th>ID</th>
                                <td>{{ $car->id }}</td>
                            </tr>
                            <tr>
                                <th>is_booked</th>
                                <td>{{ $car->is_booked }}</td>
                            </tr>
                            @if ($car->is_booked == 1)
                                <tr>
                                    <th>Booked By</th>
                                    {{-- <td>{{ $latestBooking->user->email ?? 'Unknown' }}</td> --}}
                                    <td>{{ $userEmail }}</td>
                                </tr>
                                <tr>
                                    <th>Deposit Amount</th>
                                    {{-- <td>${{ number_format($latestBooking->deposit_amount, 2) }}</td> --}}
                                    <td> {{ number_format($depositAmount, 2) }}
                                </tr>
                            @endif
                            <tr>
                                <th>is_sold</th>
                                <td>{{ $car->is_sold }}</td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>${{ number_format($car->price, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Color</th>
                                <td>{{ $car->color }}</td>
                            </tr>
                            <tr>
                                <th>Engine Type</th>
                                <td>{{ $car->engine_type }}</td>
                            </tr>
                            <tr>
                                <th>Transmission</th>
                                <td>{{ $car->transmission }}</td>
                            </tr>
                            <tr>
                                <th>Top Speed</th>
                                <td>{{ $car->top_speed }} km/h</td>
                            </tr>
                            <tr>
                                @php
                                    $media = $car->getFirstMedia('mainImage'); //more than 1 image (array)
                                    $url = $car->getFirstMediaUrl('mainImage');
                                    //dd($media);
                                @endphp
                                <th>Main Image</th>
                                <td>
                                    <img src="{{ $media?->getUrl() }}" alt="" width="100">
                                </td>
                            </tr>
                            <tr>
                                @php
                                    $mediaItems = $car->getMedia('gallery');
                                    $url = $car->getFirstMediaUrl('gallery');
                                    //dd($car, $mediaItems, $url);
                                    //dd($mediaItems);
                                    //dd($url);
                                @endphp
                                @foreach ($mediaItems as $image)
                            <tr>
                                <th>gallery</th>
                                <td>
                                    <img src="{{ $image->getUrl() }}" alt="" width="100">
                                    {{-- dd($image->getUrl()); --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
