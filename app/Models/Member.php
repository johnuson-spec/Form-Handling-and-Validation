<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'date_of_birth', 'password'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'date_of_birth' => 'date',
        ];
    }

    public function books()
    {
        return $this->belongsToMany(Book::class)
                    ->withPivot('borrowed_at', 'returned_at')
                    ->withTimestamps();
    }
}