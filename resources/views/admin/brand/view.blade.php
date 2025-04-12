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
                                <td>{{ $brand->id }}</td>
                            </tr>
                            <tr>
                                <th>NAME</th>
                                <td>{{ $brand->name  }}</td>
                            </tr>

                           <tr>
                            @php $media = $brand->getFirstMedia("brand_image");//more than 1 image (array)
                            $url = $media->getUrl();
                            //dd($brand, $media, $url);
                            //dd($url);
                            @endphp
                                <th>Brand Image</th>
                                <td>
                                    <img src="{{ $media->getUrl() }}" alt="" width="100">
                                </td>
                            </tr>
                                                  
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
