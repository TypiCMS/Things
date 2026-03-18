@extends('pages::public.master')

@section('bodyClass', 'body-things body-things-index body-page body-page-' . $page->id)

@section('page')
    <x-core::json-ld :schema="[
        '@context' => 'https://schema.org',
        '@type' => 'ItemList',
        'itemListElement' => $models
            ->map(
                fn($item, $index) => [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'url' => $item->url(),
                ],
            )
            ->all(),
    ]" />
    <div class="page-body">
        <div class="page-body-container">
            @include('pages::public._main-content', ['page' => $page])
            @include('files::public._document-list', ['model' => $page])
            @include('files::public._image-list', ['model' => $page])

            @includeWhen($models->count() > 0, 'things::public._list', ['items' => $models])
        </div>
    </div>
@endsection
