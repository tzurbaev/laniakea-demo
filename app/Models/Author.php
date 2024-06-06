<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'bio', 'photo_url'];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function genres(): HasManyThrough
    {
        return $this->hasManyThrough(Genre::class, Book::class);
    }
}
