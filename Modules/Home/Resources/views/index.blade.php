@extends('tabler.layouts.main')

@section('title')
    @lang('home::index.title')
@stop

@section('content')
    <p>
        @lang('home::index.text'): {!! config('home.name') !!}
    </p>
@stop
