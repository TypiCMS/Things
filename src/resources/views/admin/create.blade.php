@extends('core::admin.master')

@section('title', __('New thing'))

@section('content')
    {!! BootForm::open()->action(route('admin::index-things'))->multipart()->role('form') !!}
    @include('things::admin._form')
    {!! BootForm::close() !!}
@endsection
