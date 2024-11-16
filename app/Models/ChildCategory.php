<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChildCategory extends Model
{
    use SoftDeletes;

    protected $table = 'child_categories';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'parent_id'
    ];
}
