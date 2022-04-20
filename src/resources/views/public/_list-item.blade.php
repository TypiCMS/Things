<li class="thing-list-item">
    <a class="thing-list-item-link" href="{{ $thing->uri() }}" title="{{ $thing->title }}">
        <div class="thing-list-item-title">{{ $thing->title }}</div>
        <div class="thing-list-item-image-wrapper">
            @empty (!$thing->image)
            <img class="thing-list-item-image" src="{{ $thing->present()->image(null, 200) }}" width="{{ $thing->image->width }}" height="{{ $thing->image->height }}" alt="{{ $thing->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
