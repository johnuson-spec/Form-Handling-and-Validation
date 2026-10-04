<x-layout title="All Books">
    <h1>Book Collection</h1>
    <ul>
        @foreach ($books as $b)
            <li>
                <a href="{{ route('books.show', $b) }}">
                    {{ $b->title }}
                </a>
                by {{ $b->author->name }} (ISBN: {{ $b->isbn }})
            </li>
        @endforeach
    </ul>
</x-layout>