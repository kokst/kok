@extends('tabler.layouts.auth')
@section('content')
    {!! Form::open(['url' => url(config('tabler.url.post-confirm', 'password/confirm')), 'method' => 'POST', 'class' => 'card']) !!}

    <div class="card-body p-6">
        <div class="card-title">@lang('confirm.title')</div>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="form-group">
            {!! Form::label('password', trans('confirm.password'), ['class' => 'form-label']) !!}
            {!! Form::password('password', ['class' => ['form-control', $errors->has('password') ? 'is-invalid' : ''], 'placeholder' => trans('confirm.password-placeholder')]) !!}

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-block">@lang('confirm.send')</button>
        </div>
    </div>
    {!! Form::close() !!}
@stop
