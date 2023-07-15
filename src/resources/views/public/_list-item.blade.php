<li class="thing-list-item">
    <a class="thing-list-item-link" href="{{ $thing->uri() }}" title="{{ $thing->title }}">
        <div class="thing-list-item-title">{{ $thing->title }}</div>
        <div class="thing-list-item-image-wrapper">
            <img class="thing-list-item-image" src="{{ $thing->present()->image(800, 600) }}" width="400" height="300" alt="{{ $thing->image?->alt_attribute }}" />
        </div>
    </a>
</li>
