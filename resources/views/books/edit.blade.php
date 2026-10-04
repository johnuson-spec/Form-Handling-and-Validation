<x-layout title="Edit Book">
    <h1>Edit: {{ $book->title }}</h1>
    <form method="POST" action="{{ route('books.update', $book) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('books._form')
        <button type="submit" style="margin-top: 1rem;">Update Book</button>
    </form>
</x-layout>