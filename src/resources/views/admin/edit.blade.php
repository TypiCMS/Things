@extends('core::admin.master')

@section('title', $model->presentTitle())

@section('content')
    {!! BootForm::open()->put()->action(route('admin::update-thing', $model->id))->addClass('form') !!}
    {!! BootForm::bind($model) !!}
    @include('things::admin._form')
    {!! BootForm::close() !!}
@endsection
