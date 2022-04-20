@extends('core::public.master')

@section('title', $model->title.' – '.__('Things').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-things body-thing-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="thing">
    <header class="thing-header">
        <div class="thing-header-container">
            <div class="thing-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Things', 'model' => $model])
            </div>
            <h1 class="thing-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="thing-body">
        @include('things::public._json-ld', ['thing' => $model])
        @empty(!$model->summary)
        <p class="thing-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="thing-picture">
            <img class="thing-picture-image" src="{{ $model->present()->image(2000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="thing-picture-legend">{{ $model->image->description }}</legend>
            @endempty
        </picture>
        @endempty
        @empty(!$model->body)
        <div class="rich-content">{!! $model->present()->body !!}</div>
        @endempty
        @include('files::public._documents')
        @include('files::public._images')
    </div>
</article>

@endsection
