<ul class="thing-list-list">
    @foreach ($items as $thing)
        @include('things::public._list-item')
    @endforeach
</ul>
