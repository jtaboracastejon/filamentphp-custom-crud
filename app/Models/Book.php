<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'original_title',
        'es_title',
        'author',
        'genre',
        'year',
        'synopsis',
        'cover',
        'cover_file_names',
    ];
}
