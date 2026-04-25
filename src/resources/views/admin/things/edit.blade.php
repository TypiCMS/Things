@extends('admin::core.master')

@section('title', $model->presentTitle())

@section('content')
    {!! BootForm::open()->put()->action(route('admin::update-thing', $model->id))->addClass('form') !!}
    {!! BootForm::bind($model) !!}
    @include('admin::things._form')
    {!! BootForm::close() !!}
@endsection
