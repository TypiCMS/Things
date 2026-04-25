@extends('admin::core.master')

@section('title', __('New thing'))

@section('content')
    {!! BootForm::open()->action(route('admin::index-things'))->addClass('form') !!}
    @include('admin::things._form')
    {!! BootForm::close() !!}
@endsection
