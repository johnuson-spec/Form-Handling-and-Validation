<?php

namespace App\Http\Controllers;

use App\Http\Requests\BorrowBookRequest;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        return view('books.index', [
            'books' => Book::with('author')->latest()->get()
        ]);
    }

    public function create()
    {
        return view('books.create', [
            'book' => new Book(),
            'authors' => Author::orderBy('name')->get()
        ]);
    }

    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('cover')) {
            $data['cover_path'] = $request->file('cover')->store('covers', 'public');
        }
        unset($data['cover']);

        $book = Book::create($data);

        return redirect()->route('books.show', $book)
            ->with('status', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        return view('books.show', [
            'book' => $book,
            'members' => Member::orderBy('name')->get()
        ]);
    }

    public function edit(Book $book)
    {
        return view('books.edit', [
            'book' => $book,
            'authors' => Author::orderBy('name')->get()
        ]);
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $data = $request->validated();

        if ($request->hasFile('cover')) {
            if ($book->cover_path) {
                Storage::disk('public')->delete($book->cover_path);
            }
            $data['cover_path'] = $request->file('cover')->store('covers', 'public');
        }
        unset($data['cover']);

        $book->update($data);

        return redirect()->route('books.show', $book)
            ->with('status', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        if ($book->cover_path) {
            Storage::disk('public')->delete($book->cover_path);
        }
        $book->delete();

        return redirect()->route('books.index')
            ->with('status', 'Book deleted successfully.');
    }

    public function borrow(BorrowBookRequest $request, Book $book)
    {
        $book->members()->attach($request->member_id, [
            'borrowed_at' => now(),
        ]);

        return redirect()->route('books.show', $book)
            ->with('status', 'Book issued successfully.');
    }
}