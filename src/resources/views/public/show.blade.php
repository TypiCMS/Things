@extends('core::public.master')

@section('title', $model->title . ' – ' . __('Things') . ' – ' . $websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->ogImage())
@section('bodyClass', 'body-things body-thing-' . $model->id . ' body-page body-page-' . $page->id)

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
            @if (!empty($model->summary))
                <p class="thing-summary">{!! nl2br($model->summary) !!}</p>
            @endif

            @if (!empty($model->image))
                <figure class="thing-picture">
                    <img class="thing-picture-image" src="{{ $model->present()->image(2000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="" />
                    @if (!empty($model->image->description))
                        <figcaption class="thing-picture-legend">{{ $model->image->description }}</figcaption>
                    @endif
                </figure>
            @endif

            @if (!empty($model->body))
                <div class="rich-content">{!! $model->present()->body !!}</div>
            @endif

            @include('files::public._document-list')
            @include('files::public._image-list')
        </div>
    </article>
@endsection
