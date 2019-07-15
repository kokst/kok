@extends('tabler.layouts.auth')
@section('content')
    {!! Form::open(['url' => url(config('tabler.url.post-login', 'login')), 'method' => 'POST', 'class' => 'card']) !!}
    <div class="card-body p-6">
        <div class="card-title">@lang('login.title')</div>

        <div class="form-group">
            {!! Form::label('email', trans('login.email'), ['class' => 'form-label']) !!}
            {!! Form::email('email', old('email'), ['placeholder' => trans('login.email-placeholder'), 'class' => ['form-control', $errors->has('email') ? 'is-invalid' : ''], 'autofocus' => true]) !!}

            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label class="form-label" for="password">
                @lang('login.password')
                <a href="{!! url(config('tabler.urls.forgot', 'password/reset')) !!}" class="float-right small">@lang('login.forgot')</a>
            </label>
            {!! Form::password('password', ['class' => ['form-control', $errors->has('password') ? 'is-invalid' : ''], 'placeholder' => trans('login.password-placeholder')]) !!}

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label class="custom-control custom-checkbox">
                {!! Form::checkbox('remember', null, false, ['class' => 'custom-control-input']) !!}
                <span class="custom-control-label">@lang('login.remeber-me')</span>
            </label>
        </div>

        <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-block">@lang('login.signin')</button>
        </div>
    </div>
    {!! Form::close() !!}
    @if (Route::has('register'))
        <div class="text-center text-muted">
            <a href="{!! url(config('tabler.url.register', 'register')) !!}">@lang('login.register')</a>
        </div>
    @endif
@stop
