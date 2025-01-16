@extends('layouts.admin_layout')

@push('title')
    {{ @$page_title }}
@endpush

@push('css')
    <link href="{{ asset('assets/css/logs.css?v=' . rand(1,999)) }}" rel="stylesheet"/>
    @if(LaravelLocalization::getCurrentLocale() === 'ar')
        <link href="{{ asset('assets/css/logs-rtl.css?v=' . rand(1,999)) }}" rel="stylesheet"/>
    @endif
@endpush

@section('title', @$page_title)

@section('content')
    @include('admin.courseSessions._filterLog')

    <div class="card pt-3 mt-2 bodyk">
        <h1>{{trans('vcr.session_logs')}}</h1>

        <ul class="timeline-cards custom-timeline">
            @if($rows->isNotEmpty())
                @foreach($rows as $row)
                    @php
                        $rowColor = ['#41516C', '#FBCA3E', '#E24A68', '#1B5F8C', '#4CADAD'][$loop->index % 5];
                        $oldData = json_decode($row->old_data, true);
                        $newData = json_decode($row->new_data, true);
                    @endphp
                    <li class="timeline-item" style="--accent-color: {{ $rowColor }}">
                        <div class="date">
                            {{ $row->created_at->format('d') }}
                            {{ trans("months.{$row->created_at->format('M')}") }}
                            {{ $row->created_at->format('Y') }}
                            {{ $row->created_at->format('H:i') }}
                        </div>
                        <div class="title">
                            <span class="text-success">{{$row->action_name}}</span>
                        </div>
                        <div class="descr">
                            @if(!empty($row->user->name))
                                <p><strong>{{ trans('vcr.user') }}:</strong> {{ $row->user->name }}</p>
                            @endif
                                @if(!empty($row->user->type))
                                    <p><strong>{{ trans('vcr.user_type') }}:</strong>
                                        {{ \App\Modules\Users\UserEnums::getLabel($row->user->type) }}
                                    </p>
                                @endif
                            <p><strong>{{ trans('vcr.Description') }}:</strong> {{ $row->description ?? '' }}
                            </p>
                            @if($row->action == \App\Modules\VCRSessions\Enums\VCRLogEnum::RECORD_MEETING && !empty($row->url))
                                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                   data-bs-target="#videoModal{{ $loop->index }}">{{trans('vcr.View_Recording')}}</a>
                            @endif

                            @if(!empty($newData) && is_array($newData))
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#changeDetailsModal{{ $loop->index }}">
                                    {{ trans('vcr.View_Changes') }}
                                </button>
                            @endif
                        </div>

                        <div class="modal fade" id="changeDetailsModal{{ $loop->index }}" tabindex="-1"
                             aria-labelledby="changeDetailsModalLabel{{ $loop->index }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"
                                            id="changeDetailsModalLabel{{ $loop->index }}">{{ trans('vcr.Change_Details') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if(is_array($newData))
                                            <ul class="list-unstyled">
                                                @foreach($newData as $key => $value)
                                                    @if( $key !== 'updated_at')
                                                        <li class="mb-2">
                                                            <p class="timeline-key mb-1">
                                                                <strong>{{ trans('vcr.' . $key) }}:</strong>
                                                            </p>
                                                            <div class="timeline-value">
                                                                <span class="before-value d-block">
                                                                    <strong>{{ trans('app.Before') }}:</strong>
                                                                    {{ $oldData[$key] ?? trans('app.Not available') }}
                                                                </span>
                                                                <span class="after-value d-block">
                                                                    <strong>{{ trans('app.After') }}:</strong>
                                                                    {{ $value }}
                                                                </span>
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($row->action == \App\Modules\VCRSessions\Enums\VCRLogEnum::RECORD_MEETING && !empty($row->url))
                            <div class="modal fade" id="videoModal{{ $loop->index }}" tabindex="-1"
                                 aria-labelledby="videoModalLabel{{ $loop->index }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="videoModalLabel{{ $loop->index }}">{{trans('vcr.View_Recording')}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <video width="100%" controls>
                                                <source src="{{ $row->url }}" type="video/mp4">
                                                {{trans('vcr.Your browser does not support the video tag.')}}
                                            </video>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </li>
                @endforeach
            @else
                @include('partials.noData')
            @endif
        </ul>

        <div class="loader" id="loader">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            let loading = false;
            let nextPageUrl = '{{ $rows->nextPageUrl() }}';
            let indexCounter = {{ $rows->count() }};
            let loader = $('#loader');

            $(window).scroll(function () {
                if (!loading && $(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                    if (nextPageUrl) {
                        loading = true;
                        loader.addClass('show');

                        $.ajax({
                            url: nextPageUrl,
                            method: 'GET',
                            success: function (response) {
                                response.rows.forEach(function (row, index) {
                                    let rowColor = ['#41516C', '#FBCA3E', '#E24A68', '#1B5F8C', '#4CADAD'][indexCounter % 5];
                                    let oldData = row.old_data ? JSON.parse(row.old_data) : {};
                                    let newData = row.new_data ? JSON.parse(row.new_data) : {};

                                    let modalHtml = '';
                                    if (newData && typeof newData === 'object') {
                                        let changeDetails = Object.keys(newData)
                                            .filter(key => key !== 'updated_at')
                                            .map(key => `
                                        <li class="mb-2">
                                            <p class="timeline-key mb-1"><strong>${key}:</strong></p>
                                            <div class="timeline-value">
                                                <span class="before-value d-block"><strong>{{ trans('app.Before') }}:</strong> ${oldData[key] || 'Not available'}</span>
                                                <span class="after-value d-block"><strong>{{ trans('app.After') }}:</strong> ${newData[key]}</span>
                                            </div>
                                        </li>
                                    `).join('');

                                        modalHtml = `
                                    <div class="modal fade" id="changeDetailsModal${indexCounter}" tabindex="-1" aria-labelledby="changeDetailsModalLabel${indexCounter}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="changeDetailsModalLabel${indexCounter}"> {{ trans('vcr.Change_Details') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <ul class="list-unstyled">
                                                        ${changeDetails}
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                    }

                                    let rowHtml = `
                                <li class="timeline-item" style="--accent-color: ${rowColor}">
                                    <div class="date">
                                        ${row.formatted_date}
                                        ${row.translated_month}
                                        ${row.formatted_time}
                                    </div>
                                    <div class="title">
                                        <span class="text-success">${row.action_name}</span>
                                    </div>
                                    <div class="descr">
<p><strong>{{ trans('vcr.user') }}:</strong> ${row.user ? row.user.first_name || '' : ''} ${row.user ? row.user.last_name || '' : ''}</p>
                                        <p><strong>{{ trans('vcr.user_type') }}:</strong> ${row.action_type || ''}</p>
                                        <p><strong>{{ trans('vcr.Description') }}:</strong> ${row.description || ''}</p>
                                        ${newData && typeof newData === 'object' && Object.keys(newData).length > 0 ? `
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#changeDetailsModal${indexCounter}">
                                                 {{ trans('vcr.View_Changes') }}
                                    </button>
                                    ` : ''}
                                    </div>
                                    ${modalHtml}
                                </li>
                            `;


                                    $('.custom-timeline').append(rowHtml);
                                    indexCounter++;
                                });

                                nextPageUrl = response.next_page_url;
                                loader.removeClass('show');
                                loading = false;
                            },
                            error: function () {
                                loader.removeClass('show');
                                loading = false;
                            }
                        });
                    }
                }
            });
        });

    </script>
@endpush
