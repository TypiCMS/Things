@extends('core::public.master')

@section('title', $model->title . ' – ' . __('Things') . ' – ' . $websiteTitle)
@section('ogTitle', $model->title ?? '')
@section('description', $model->summary ?? '')
@section('ogImage', $model->ogImageUrl())
@section('bodyClass', 'body-things body-thing-' . $model->id . ' body-page body-page-' . $page->id)

@section('content')
    <article class="thing">
        <header class="thing-header">
            <div class="thing-header-container">
                <div class="thing-header-navigator">
                    <x-core::items-navigator :$model :$page />
                </div>
                <h1 class="thing-title">{{ $model->title }}</h1>
            </div>
        </header>
        <div class="thing-body">
            {{-- <x-core::json-ld :schema="[
                '@context' => 'https://schema.org',
                '@type' => '',
                'name' => $model->title,
                'description' => $model->summary !== '' ? $model->summary : strip_tags($model->body),
                'image' => [$model->image?->render()],
                'mainEntityOfPage' => [
                    '@type' => 'WebPage',
                    '@id' => $model->url(),
                ],
            ]" /> --}}
            @if ($model->summary)
                <p class="thing-summary">{!! nl2br($model->summary) !!}</p>
            @endif

            @if ($model->image)
                <figure class="thing-picture">
                    <img class="thing-picture-image" src="{{ $model->image->render(2000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="" />
                    @if ($model->image->description)
                        <figcaption class="thing-picture-legend">{{ $model->image->description }}</figcaption>
                    @endif
                </figure>
            @endif

            @if ($model->body)
                <div class="rich-content">{!! $model->formattedBody() !!}</div>
            @endif

            @include('files::public._document-list')
            @include('files::public._image-list')
        </div>
    </article>
@endsection
