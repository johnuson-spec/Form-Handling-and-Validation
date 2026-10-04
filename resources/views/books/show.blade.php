<x-layout :title="$book->title">
    <h1>{{ $book->title }}</h1>
    <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
    <p><strong>Author:</strong> {{ $book->author->name }}</p>
    <p><strong>Published:</strong> {{ $book->published_year }}</p>
    <p><strong>Type:</strong> {{ $book->is_reference ? 'Reference Only' : 'Circulating' }}</p>

    @if ($book->cover_path)
        <p><img src="{{ asset('storage/' . $book->cover_path) }}" width="200" alt="Cover"></p>
    @endif

    <hr>

    <h3>Circulation Desk (Borrow)</h3>
    @if ($book->is_reference)
        <p><em>Reference books cannot be checked out.</em></p>
    @else
        <form method="POST" action="{{ route('books.borrow', $book) }}">
            @csrf
            <x-forms.select name="member_id" label="Member" :options="$members->pluck('name', 'id')" placeholder="Select Member" />
            <button type="submit" style="margin-top: .5rem;">Issue Book</button>
        </form>
    @endif

    <hr>
    
    <p><a href="{{ route('books.edit', $book) }}">Edit Book Details</a></p>

    <form method="POST" action="{{ route('books.destroy', $book) }}" onsubmit="return confirm('Are you sure?');">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Book</button>
    </form>
</x-layout>