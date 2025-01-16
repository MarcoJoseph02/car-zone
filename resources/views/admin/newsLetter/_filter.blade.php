@push('css')
    <link rel="stylesheet" type="text/css" href="/assets/css/select2.min.css">
@endpush
<div class="card mt-3 pt-3">
    <div class="card-header">
        <h5 class="mb-0">{{ __("news_letter_email.news_letter_email_filters") }}</h5>
    </div>
    <div class="card-body">
        {!! Form::open(['method' => 'get']) !!}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label-behind">{{ __("users.email") }}</label>
                    <input type="email" autocomplete="off" name="email"
                           value="{{ old("email", request()->get("email")) }}" placeholder="{{ __("users.email") }}"
                           class="form-control">
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <button class="btn btn-md btn-primary"><i class="mdi mdi-filter"></i> {{ trans('app.Search') }}
                    </button>
                    <a class="btn btn-md btn-danger" href="{{url()->current()}}" role="button"><i
                                class="mdi mdi-delete-circle"></i> {{ trans('app.reset') }}</a>
                </div>
            </div>
        </div>

    </div>
    {!! Form::close() !!}
</div>

@push('js')
    <script src="/assets/js/select2.full.min.js"></script>
    <script src="/assets/js/form-select2.min.js"></script>
@endpush
