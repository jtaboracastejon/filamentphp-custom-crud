<?php

namespace App\Models;

use App\Observers\BookObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(classes: [BookObserver::class])]
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

    protected $casts = [
        'cover' => 'array',
        'cover_file_names' => 'array',
    ];
}
