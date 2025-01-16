<div class="card">
    <div class="card-body">
        {!! Form::open(['method' => 'get']) !!}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label-behind">{{ __("users.first_name") }}</label>
                    <input type="text" autocomplete="off" style="height: 55px" name="first_name"
                           value="{{ old("first_name", request()->get("first_name")) }}"
                           placeholder="{{ __("users.first_name") }}" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label-behind"> {{ __("users.last_name") }}</label>
                    <input type="text" autocomplete="off" style="height: 55px" name="last_name"
                           value="{{ old("last_name", request()->get("last_name")) }}"
                           placeholder="{{ __("users.last_name") }}" class="form-control">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label-behind">{{ __("users.email") }}</label>
                    <input type="email" autocomplete="off" style="height: 55px" name="email"
                           value="{{ old("email", request()->get("email")) }}" placeholder="{{ __("users.email") }}"
                           class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label-behind"> {{ __("users.mobile") }}</label>
                    <input type="text" autocomplete="off" style="height: 55px" name="mobile"
                           value="{{ old("mobile", request()->get("mobile")) }}" placeholder="{{ __("users.mobile") }}"
                           class="form-control">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label-behind">{{ __("payment_transaction.from") }}</label>
                    <input type="date" class="form-control" name="from_date"
                           value="{{ old("from_date", request()->get("from_date")) }}"
                           placeholder="{{ __("quiz.date") }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label-behind">{{ __("payment_transaction.to") }}</label>
                    <input type="date" class="form-control" name="to_date"
                           value="{{ old("from_to", request()->get("to_date")) }}" placeholder="{{ __("quiz.date") }}">
                </div>
            </div>

        </div>

        <div class="col-md-6 form-group">
            <button class="btn btn-md btn-success"><i class="mdi mdi-filter"></i> {{ trans('app.Search') }} </button>
            <a class="btn btn-md btn-success" href="{{url()->current()}}" role="button"><i
                        class="mdi mdi-delete-circle"></i> {{ trans('app.reset') }}</a>
        </div>

    </div>
    {!! Form::close() !!}
</div>
