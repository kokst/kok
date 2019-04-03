@extends('tabler.layouts.main')

@section('content')
    <h1>@lang('home::index.title')</h1>

    <p>
        @lang('home::index.text'): {!! config('home.name') !!}
    </p>
@stop
