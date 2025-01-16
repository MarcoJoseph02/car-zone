@extends('layouts.admin_layout')
@push('title')
    {{ @$page_title }}
@endpush
@section('title', @$page_title)
@section('content')
    <div class="row">
        <div class="card pt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ trans('courses.subscribers_list') }}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0 w-99">
                        <thead>
                        <tr>
                            <th class="text-center">{{ trans('courses.Name') }}</th>
                            <th class="text-center">{{ trans('courses.Mobile') }}</th>
                            <th class="text-center">{{ trans('courses.Email') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subscribers as $subscriber)
                            <tr>
                                <td class="align-middle text-center pt-3 text-sm">
                                    <p class="text-xs font-weight-bold mb-0">{{ $subscriber->name }}</p>
                                </td>
                                <td class="align-middle text-center pt-3" dir="ltr">
                                    <h6 class="text-xs font-weight-bold mb-0">{{ $subscriber->mobile }}</h6>
                                </td>
                                <td class="align-middle text-center pt-3">
                                    <h6 class="text-xs font-weight-bold mb-0">{{ $subscriber->email }}</h6>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    {{ $subscribers->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
