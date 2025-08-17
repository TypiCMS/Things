@extends('core::admin.master')

@section('title', __('New thing'))

@section('content')
    {!! BootForm::open()->action(route('admin::index-things'))->addClass('main-content') !!}
    @include('things::admin._form')
    {!! BootForm::close() !!}
@endsection
