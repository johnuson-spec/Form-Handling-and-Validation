<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Author::factory(10)->has(Book::factory(4))->create();

        $members = Member::factory(30)->create();
        $allBooks = Book::all();

        foreach ($members as $member) {
            $randomBooks = $allBooks->random(rand(1, 3));
            foreach ($randomBooks as $book) {
                $isReturned = fake()->boolean(80);
                $member->books()->attach($book->id, [
                    'borrowed_at' => now()->subDays(rand(1, 30)),
                    'returned_at' => $isReturned ? now()->subDays(rand(0, 5)) : null,
                ]);
            }
        }
    }
}