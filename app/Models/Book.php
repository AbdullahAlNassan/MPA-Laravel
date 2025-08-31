<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'published_year',
        'pages',
        'cover_url',
        'cover_path',
        'genre_id'
    ];

    public function genre()
    {
        return $this->belongsTo(\App\Models\Genre::class);
    }

}
