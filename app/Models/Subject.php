<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use SoftDeletes;

    protected $table = 'subjects';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'description',
        'image',
        'sorting',
        'price',
        'special_price',
        'special_price_till_date',
        'status',
        'is_able_to_sold_seperate',
        'class_id',
        'user_id',
        'tags'
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
        return $this->hasMany(Course::class);
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
    public function student_grade(): HasMany
    {
        return $this->hasMany(StudentGrade::class);
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
