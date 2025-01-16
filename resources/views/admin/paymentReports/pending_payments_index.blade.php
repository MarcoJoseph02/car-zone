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
                <h5 class="mb-0">{{ __('payment_transaction.pending payments transactions reports') }}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0 w-99">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center">{{ trans('payment_transaction.student_name') }}</th>
                            <th class="text-center">{{ trans('payment_transaction.User Mobile') }}</th>
                            <th class="text-center">{{ trans('payment_transaction.date_time') }}</th>
                            <th class="text-center">{{ trans('payment_transaction.course') }}</th>
                            <th class="text-center">{{ trans('payment_transaction.amount') }}</th>
                            <th class="text-center">{{ trans('app.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $row)
                            <tr class="text-center">
                                <td>{{ $row->user->name }}</td>
                                <td>{{ $row->user->mobile }}</td>
                                <td>{{\Carbon\Carbon::parse($row->created_at)->format('Y-m-d H:i:s')}}</td>
                                <td>{{  $row->course->name ?? '' }}</td>
                                <td>{{ $row->amount }}</td>
                                <td class="align-middle text-center pt-5">
                                    <div class="row">
                                        <div class="form-group">
                                            <a
                                                    class="btn btn-xs btn-info"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#upload_document_{{$row->id}}"
                                                    title="{{ trans('payment_transaction.upload document') }}"
                                                    href="#"
                                                >
                                                <i class="fa fa-arrow-up"></i>
                                            </a>
                                        </div>
                                        <div class="modal fade" id="upload_document_{{$row->id}}" tabindex="-1"
                                             role="dialog"
                                             aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" class="" enctype="multipart/form-data"
                                                              action="{{route('admin.paymentReport.put.updateDocument',$row->id)}}">
                                                            {{ csrf_field() }}
                                                            <div class="form-group" style="margin-top: 20px">
                                                                @php
                                                                    $attributes=[
                                                                        'id'=>'preview_media',
                                                                        'class'=>'form-control',
                                                                        'label'=>__('payment_transaction.upload document'),
                                                                        'placeholder'=>__('payment_transaction.upload document'),
                                                                        "accept"=>"image/png, image/jpeg, image/jpg",
                                                                        "required"=>"required"
                                                                        ];
                                                                @endphp
                                                                @include('form.file',['name'=>'document', 'value'=> null ,'attributes'=>$attributes])

                                                            </div>
                                                            <div class="form-group" style="margin-top: 20px">
                                                                <button type="submit"
                                                                        class="btn btn-primary">{{ trans('app.Save') }}</button>
                                                                <button type="button" class="btn btn-danger"
                                                                        data-bs-dismiss="modal">{{trans('app.cancel')}}</button>

                                                            </div>

                                                        </form>
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
