@extends('layouts.admin_layout')
@push('title')
    {{ @$page_title }}
@endpush
@section('title', @$page_title)

@section('content')
    @include('admin.paymentReports._filter_failed_payments')
    @if(!$rows->isEmpty())
        <div class="card mt-3 pt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ trans('payment_transaction.failed_transactions') }}</h5>
                <div>
                    <a href="{{route('admin.paymentReport.indexExport',['type' => 'failed'] + request()->query())}}" class="@if($rows->isEmpty() || empty(request()->all())) disabled @endif btn btn-md btn-primary pull-right" role="button"><i class="mdi mdi-delete-circle"></i> {{ trans('app.Export') }}</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0 w-99">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center">{{ trans('payment_transaction.student_name') }}</th>
                            <th class="text-center">{{ trans('payment_transaction.instructor name') }}</th>
                            <th class="text-center">{{ trans('payment_transaction.date_time') }}</th>
                            <th class="text-center">{{ trans('payment_transaction.course') }}</th>
                            <th class="text-center">{{ trans('payment_transaction.amount') }}</th>
                            <th class="text-center">{{ trans('payment_transaction.reason for failure') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $row)
                            <tr class="text-center">
                                <td>{{ $row->user->name }}</td>
                                <td>{{ $row->course->instructor->name }}</td>
                                <td>{{\Carbon\Carbon::parse($row->created_at)->format('Y-m-d H:i:s')}}</td>
                                <td>{{  $row->course->name ?? '' }}</td>
                                <td>{{ $row->amount }}</td>
                                <td>
                                    {{!empty($row->failure_reason_key) ?  __('payment_transaction.' . $row->failure_reason_key) : " "}}
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
        @include('partials.noData')
    @endif
@endsection
