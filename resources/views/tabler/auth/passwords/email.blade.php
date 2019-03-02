@extends('tabler.layouts.auth')
@section('content')
    {!! Form::open(['url' => url(config('tabler.url.post-email', 'password/email')), 'method' => 'POST', 'class' => 'card']) !!}
    <div class="card-body p-6">
        <div class="card-title">@lang('email.title')</div>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="form-group">
            {!! Form::label('email', trans('email.email'), ['class' => 'form-label']) !!}
            {!! Form::email('email', old('email'), ['placeholder' => trans('email.email-placeholder'), 'class' => ['form-control', $errors->has('email') ? 'is-invalid' : '']]) !!}

            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-block">@lang('email.send')</button>
        </div>
    </div>
    {!! Form::close() !!}
    <div class="text-center text-muted">
        <a href="{!! url(config('tabler.url.register', 'register')) !!}">@lang('login.register')</a>
    </div>
@stop