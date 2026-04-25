<ul class="thing-list-results-list">
    @foreach ($items as $thing)
        <li class="thing-list-results-item">
            <a class="thing-list-results-item-link" href="{{ $thing->url() }}" title="{{ $thing->title }}">
                <span class="thing-list-results-item-title">{{ $thing->title }}</span>
            </a>
        </li>
    @endforeach
</ul>
