<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('books.index'));

Route::resource('books', BookController::class);
Route::post('books/{book}/borrow', [BookController::class, 'borrow'])->name('books.borrow');

Route::get('members/register', [MemberController::class, 'create'])->name('members.register');
Route::post('members/register', [MemberController::class, 'store'])->name('members.register.store');
