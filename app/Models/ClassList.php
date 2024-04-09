<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassList extends Model
{
    use SoftDeletes;

    protected $table = 'classes';

    public $timestamps = true;

    protected $fillable = [
        'name'
    ];

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function course(): HasMany
    {
        return $this->hasMany(Course::class, 'class_id');
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function newnessclass(): HasMany
    {
        return $this->hasMany(NewnessClass::class);
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function student_assessment(): HasMany
    {
        return $this->hasMany(StudentAssessment::class);
    }
}
