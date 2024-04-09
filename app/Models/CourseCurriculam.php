<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseCurriculam extends Model
{
    use SoftDeletes;

    protected $table = 'course_curriculams';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'display_order',
        'status',
        'course_id'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

     /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function curriculam_lecture(): HasMany
    {
        return $this->hasMany(CurriculamLecture::class, 'course_curriculam_id');
    }
}
