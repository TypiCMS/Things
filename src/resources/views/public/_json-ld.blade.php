{{--
    <script type="application/ld+json">
    {
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $thing->title }}",
    "description": "{{ $thing->summary !== '' ? $thing->summary : strip_tags($thing->body) }}",
    "image": [
    "{{ $thing->present()->image() }}"
    ],
    "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{ $thing->uri() }}"
    }
    }
    </script>
--}}
