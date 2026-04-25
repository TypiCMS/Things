<ul class="thing-list-list">
    @foreach ($items as $thing)
        @include('public::things._list-item')
    @endforeach
</ul>
