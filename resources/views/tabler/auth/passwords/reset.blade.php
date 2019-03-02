@extends('tabler.layouts.auth')
@section('content')
    {!! Form::open(['url' => url(config('tabler.url.post-reset', 'password/reset')), 'method' => 'POST', 'class' => 'card']) !!}

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="card-body p-6">
        <div class="card-title">@lang('reset.title')</div>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="form-group">
            {!! Form::label('email', trans('reset.email'), ['class' => 'form-label']) !!}
            {!! Form::email('email', old('email'), ['placeholder' => trans('reset.email-placeholder'), 'class' => ['form-control', $errors->has('email') ? 'is-invalid' : '']]) !!}

            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            {!! Form::label('password', trans('reset.password'), ['class' => 'form-label']) !!}
            {!! Form::password('password', ['class' => ['form-control', $errors->has('password') ? 'is-invalid' : ''], 'placeholder' => trans('reset.password-placeholder')]) !!}

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            {!! Form::label('password_confirmation', trans('reset.password-confirmation'), ['class' => 'form-label']) !!}
            {!! Form::password('password_confirmation', ['placeholder' => trans('reset.password-confirmation-placeholder'), 'class' => ['form-control', $errors->has('password_confirmation') ? 'is-invalid' : '']]) !!}

            @if ($errors->has('password_confirmation'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-block">@lang('reset.send')</button>
        </div>
    </div>
    {!! Form::close() !!}
@stop