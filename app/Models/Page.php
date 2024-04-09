<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use SoftDeletes;

    protected $table = 'pages';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'content',
        'slug'
    ];
}
