<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'name'];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function authors(): HasManyThrough
    {
        return $this->hasManyThrough(Author::class, Book::class);
    }
}
