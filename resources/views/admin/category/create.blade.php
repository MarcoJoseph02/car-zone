@extends('layouts.admin_layout')
@push('title')
    {{ @$page_title }}
@endpush
@push('css')
    <link rel="stylesheet" type="text/css" href="/css/select2.min.css">
@endpush
@section('title',@$page_title)

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Create Category</h5>
            </div>
            <div class="card-body">
                <div class="col-md-12 col-sm-12 col-xs-12 x_panel">
                    {{ Form::open(['route'=>'admin.category.store','method' => 'post','class'=>'form-vertical form-label-left','enctype' => 'multipart/form-data']) }}
                    <div class="row">

                        @include('admin.category.form')
                        <div class="form-group">
                            <div class="form-layout-footer">
                                <button type="submit" class="btn btn-success"> Save</button>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="/js/select2.full.min.js"></script>
    <script src="/js/form-select2.min.js"></script>
@endpush