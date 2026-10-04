<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id', 'isbn', 'title', 'published_year', 'is_reference', 'cover_path'
    ];

    protected function casts(): array
    {
        return ['is_reference' => 'boolean'];
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class)
                    ->withPivot('borrowed_at', 'returned_at')
                    ->withTimestamps();
    }
}