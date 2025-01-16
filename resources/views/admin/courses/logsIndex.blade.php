@extends('layouts.admin_layout')
@push('title')
    {{ @$page_title }}
@endpush
@section('title', @$page_title)
@section('content')
    <div class="accordion-1">
        <div class="row">
            <div class="card mt-3 pt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="col-md-6 mx-auto text-center">
                        <h2>{{ trans("courses.Courses Logs") }}</h2>
                    </div>
                </div>
                <div class="card-body">

                    <div class="col-md-10 mx-auto">
                        <div class="accordion" id="accordionRental">
                            @if(!$rows->isEmpty())
                                @foreach($rows as $row)
                                    <div class="accordion-item mb-3">
                                        <h5 class="accordion-header" id="headingOne">
                                            <button class="accordion-button border-bottom font-weight-bold collapsed"
                                                    type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse{{$loop->index}}"
                                                    aria-expanded="false"
                                                    aria-controls="collapseOne">
                                                {{$row->created_at->format('d')}}
                                                {{ trans("months.{$row->created_at->format('M')}") }} {{$row->created_at->format('Y')}}
                                                [<span class="text-success">{{ trans("events.{$row->event}") }}</span>]
                                                <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3"
                                                   aria-hidden="true"></i>
                                                <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3"
                                                   aria-hidden="true"></i>
                                            </button>
                                        </h5>
                                        <div id="collapse{{$loop->index}}" class="accordion-collapse collapse"
                                             aria-labelledby="headingOne"
                                             data-bs-parent="#accordionRental" style="">
                                            <div class="accordion-body text-sm opacity-8">
                                                <div class="row mb-5">

                                                    <div class="col-12 mt-lg-0 mt-4">
                                                        <!-- Card Profile -->
                                                        <div class="card card-body">
                                                            <div class="row justify-content-center align-items-center">
                                                                <div class="col-sm-auto col-8 my-auto">
                                                                    <div class="h-100 inline">
                                                                        @if($row->user_id)
                                                                            <h5 class="mb-0">
                                                                                {{ trans("app.Action taken by") }} :

                                                                                <a href="{{ route('admin.users.get.view', $row->user->id) }}"
                                                                                   target="_blank">
                                                                                    {{ $row->user->name }}
                                                                                </a>
                                                                            </h5>

                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                                                                    <div class="form-check form-switch ms-2">
                                                                        <a href="{{ route('admin.courses.get.view', request()->route('id')) }}"
                                                                           class="btn btn-success" target="_blank">
                                                                            {{ trans('subjects.View courses') }}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Card Basic Info -->
                                                        <div class="card mt-4" id="basic-course-info">
                                                            <div class="card-body p-3">

                                                                <ul class="list-group">
                                                                    @foreach($row->new_values as $key => $value)
                                                                        @if(is_array($value) || is_null($value) || in_array($key, ['password', 'password_confirmation', 'old_password']) || \Illuminate\Support\Str::contains($key, '_id'))
                                                                            @continue
                                                                        @endif
                                                                        <p class="text-center"
                                                                           style="font-weight: bold; color: #000000">{{ trans("courses.{$key}") }}</p>
                                                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                                                                            <strong class="text-dark">{{ trans("app.Before") }}
                                                                                : </strong>
                                                                            @if(isset($row->old_values[$key]))
                                                                                @if($row->old_values[$key] == '1')
                                                                                    {{ trans('app.Yes') }}
                                                                                @elseif($row->old_values[$key] == '0')
                                                                                    {{ trans('app.No') }}
                                                                                @else
                                                                                    {{str_limit($row->old_values[$key] , 30)}}
                                                                                @endif
                                                                            @endif
                                                                        </li>
                                                                        <li class="list-group-item border-0 ps-0 text-sm">
                                                                            <strong class="text-dark">{{ trans("app.After") }}
                                                                                :</strong>
                                                                            @if(isset($row->new_values[$key]))
                                                                                @if($row->new_values[$key] == '1')
                                                                                    {{ trans('app.Yes') }}
                                                                                @elseif($row->new_values[$key] == '0')
                                                                                    {{ trans('app.No') }}
                                                                                @else
                                                                                    {{str_limit($row->new_values[$key] , 30)}}
                                                                                @endif
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="pull-right">
                                    {{ $rows->links() }}
                                </div>
                            @else
                                @include('partials.noData')
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
