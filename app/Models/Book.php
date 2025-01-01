<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use SoftDeletes;

    protected $table = 'books';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'cover_image',
        'external_link',
        'author',
        'book_file',
        'created_by',
        'status',
        'price'
    ];
}
