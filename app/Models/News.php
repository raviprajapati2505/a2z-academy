<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use SoftDeletes;

    protected $table = 'news';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'image',
        'description'
    ];
}
