@extends('layouts.admin_layout')
@push('title')
    {{ @$page_title }}
@endpush
@section('title', @$page_title)
@section('content')
    <div class="row">
        @include('admin.newsLetter._filter')
        @if(!$rows->isEmpty())
            <div class="card mt-3 pt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ trans('news_letter_email.news_letter_email_List') }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0 w-99">
                            <thead>
                            <tr>
                                <th class="text-center">{{ trans('users.Email') }}</th>
                                <th class="text-center">{{ trans('users.Actions') }}</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0">{{ $row->email }}</p>
                                    </td>
                                    <td class="align-middle text-center pt-5">
                                        <a class="btn btn-xs btn-danger"
                                           href="{{  route('admin.news-letter.deleteNewsLetterEmail',$row->id) }}"
                                           data-bs-toggle="tooltip" data-bs-placement="bottom"
                                           title="{{ trans('news_letter_email.delete') }}">
                                            <i class="fa fa-clock-o"></i>
                                        </a>
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
    </div>
@endsection
