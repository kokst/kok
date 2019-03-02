@extends('tabler.layouts.auth')
@section('content')
    {!! Form::open(['url' => url(config('tabler.url.post-register', 'register')), 'method' => 'POST', 'class' => 'card']) !!}
    <div class="card-body p-6">
        <div class="card-title">@lang('register.title')</div>

        <div class="form-group">
            {!! Form::label('name', trans('register.name'), ['class' => 'form-label']) !!}
            {!! Form::text('name', old('name'), ['placeholder' => trans('register.name-placeholder'), 'class' => ['form-control', $errors->has('name') ? 'is-invalid' : ''], 'autofocus' => true]) !!}

            @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            {!! Form::label('email', trans('register.email'), ['class' => 'form-label']) !!}
            {!! Form::email('email', old('email'), ['placeholder' => trans('register.email-placeholder'), 'class' => ['form-control', $errors->has('email') ? 'is-invalid' : '']]) !!}

            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            {!! Form::label('password', trans('register.password'), ['class' => 'form-label']) !!}
            {!! Form::password('password', ['placeholder' => trans('register.password-placeholder'), 'class' => ['form-control', $errors->has('password') ? 'is-invalid' : '']]) !!}

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            {!! Form::label('password_confirmation', trans('register.password-confirmation'), ['class' => 'form-label']) !!}
            {!! Form::password('password_confirmation', ['placeholder' => trans('register.password-confirmation-placeholder'), 'class' => 'form-control']) !!}
        </div>

        <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-block">@lang('register.singup')</button>
        </div>
    </div>
    {!! Form::close() !!}
    <div class="text-center text-muted">
        <a href="{!! url(config('tabler.url.login-url', 'login')) !!}">@lang('register.login')</a>
    </div>
@stop