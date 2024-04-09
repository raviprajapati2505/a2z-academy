<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class CurriculamLecture extends Model
{
    use SoftDeletes;

    protected $table = 'curriculam_lectures';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'display_order',
        'status',
        'video',
        'description',
        'is_free',
        'duration_in_hour',
        'teacher_id',
        'course_id',
        'course_curriculam_id',
        'duration_in_seconds'
    ];

    public function course_curriculam(): BelongsTo
    {
        return $this->belongsTo(CourseCurriculam::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function track_lecture(): HasMany
    {
        return $this->hasMany(TrackLecture::class, 'curriculam_lecture_id');
    }
}
