<x-layout title="New Book">
    <h1>Add New Book</h1>
    <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
        @csrf
        @include('books._form')
        <button type="submit" style="margin-top: 1rem;">Save Book</button>
    </form>
</x-layout>