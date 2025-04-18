@extends('layouts.admin_auth_layout')

@section('body_class','login')

@section('content')
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-5 col-md-7 d-flex flex-column mx-auto">
                            @include('flash::message')
                            <div class="card card-plain">
                                <img width="300" src="/assets/img/login.png" class="m-auto">
                                <div class="card-body">
                                    {{ Form::open(['route'=>['auth.post.login']]) }}
                                    <div class="mb-3">
                                        <input  id="email" type="text" class="form-control form-control-lg" name="email" value="{{ old('email') }}" placeholder="{{ trans('app.email')}}" aria-label="Email" autofocus>
                                    </div>

                                    <div class="mb-3">
                                        <input id="password" type="password" class="form-control form-control-lg" name="password"
                                               placeholder="{{ trans('app.password') }}" aria-label="Password" autocomplete="new-password">
                                    </div>
                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    @if (isset($errors) &&!$errors->isEmpty() && count($errors))
                                        <div class="alert alert-danger" role="alert">
                                            {!! $errors->first() !!}
                                        </div>
                                    @endif
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">{{ trans('app.Login') }}</button>
                                    </div>
                                    {{ Form::close() }}
                                </div>
{{--                                <div class="card-footer text-center pt-0 px-lg-2 px-1">--}}
{{--                                    <p class="mb-4 text-sm mx-auto">--}}
{{--                                        <a href="{{ route('auth.get.resetPassword') }}" class="text-primary text-gradient font-weight-bold">{{ trans('app.reset Password') }}</a>--}}
{{--                                    </p>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
