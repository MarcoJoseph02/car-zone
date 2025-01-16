@extends('layouts.admin_layout')
@push('title')
    {{ @$page_title }}
@endpush
@section('title', @$page_title)

@section('content')

    @include('admin.paymentReports._filter_success_payments')

    @if(!$rows->isEmpty())
        <div class="card mt-3 pt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('payment_transaction.success payments transactions reports') }}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0 w-99">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center">{{ trans('payment_transaction.student_name') }}</th>
                            <th class="text-center">{{ trans('payment_transaction.date_time') }}</th>
                            <th class="text-center">{{ trans('payment_transaction.course') }}</th>
                            <th class="text-center">{{ trans('payment_transaction.amount') }}</th>
                            <th class="text-center">{{ trans('payment_transaction.rrn') }}</th>
                            <th class="text-center">{{ trans('payment_transaction.transaction_type') }}</th>
                            <th class="text-center">{{ trans('app.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $row)
                            <tr>
                                <td class="align-middle text-center text-sm">
                                    <h6 class="text-xs font-weight-bold mb-0">{{ $row->user ? $row->user->name : ""}}</h6>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <h6 class="text-xs font-weight-bold mb-0">{{  $row->created_at->format('Y-m-d H:i:s') }}</h6>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <h6 class="text-xs font-weight-bold mb-0">{{  $row->course->name ?? '' }}</h6>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <h6 class="text-xs font-weight-bold mb-0">{{ $row->amount }}</h6>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <h6 class="text-xs font-weight-bold mb-0">{{ @$row->rrn }}</h6>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <h6 class="text-xs font-weight-bold mb-0">{{ trans('payment_transaction.' . $row->payment_transaction_type) }}</h6>
                                </td>
                                <td class="align-middle text-center pt-5">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <a class="btn btn-xs btn-primary" target="_blank"
                                               href="{{ route('admin.paymentReport.getSuccessDetails',$row->id)}}"
                                               data-toggle="tooltip"
                                               data-placement="top" data-title="{{ trans('app.Details') }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
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
@section('scripts')
    @parent

    <link rel="stylesheet"
          href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('#datePickFrom').datepicker({
                dateFormat: 'yy-mm-dd'
            });
            $('#datePickTo').datepicker({
                dateFormat: 'yy-mm-dd',
            });
        });

        function replaceUrlParam(url, paramName, paramValue) {
            if (paramValue == null) {
                paramValue = '';
            }
            var pattern = new RegExp('\\b(' + paramName + '=).*?(&|#|$)');
            if (url.search(pattern) >= 0) {
                var newParams = url.replace(pattern, '$1' + paramValue + '$2');
                history.pushState({}, null, window.location.href.split('?')[0] + newParams);
            }
        }
    </script>
@endsection
