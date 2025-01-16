@extends('layouts.admin_layout')
@push('title')
    {{ @$page_title }}
@endpush
@section('title', @$page_title)
@section('content')
    <div class="row">
        @if(!$rows->isEmpty())
            <div class="card pt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ trans('courses.course Rate') }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0 w-99">
                            <thead>
                <tr>
                    <th class="text-center">{{ trans('courses.user_name') }}</th>
                    <th class="text-center">{{ trans('courses.stars') }}</th>
                    <th class="text-center">{{ trans('courses.comment') }}</th>
                    <th class="text-center">{{ trans('courses.Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rows as $row)
                    <tr class="text-center">
                        <td>{{ $row->user?->name }}</td>
                        <td>
                            {!! str_repeat('<span><i class="fas fa-solid fa-star" style="color:#f0ad4e; font-size: 15px;"></i></span>', $row->rating) !!}
                            {!! str_repeat('<span><i class="fas fa-solid fa-star" style="color:#f0ad4e4d; font-size: 15px;"></i></span>', App\OurEdu\Courses\Enums\CourseEnums::TOTAL_STARS-$row->rating) !!}
                        </td>
                        <td>{{ $row->comment }}</td>
                        <td class="align-middle text-center pt-4">
                            <div class="row">
                                <div  data-position='center'>
                                    <form method="POST" class="d-inline"
                                          action="{{route('admin.courses.rates.delete' , $row->id)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-xs btn-danger" value="Delete Station"
                                                data-confirm="{{trans('app.Are you sure you want to delete this item')}}?">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pull-right">
                {{ $rows->links() }}
            </div>
        @else
            @include('partials.noData')
        @endif
    </div>
@endsection
