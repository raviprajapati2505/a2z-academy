<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrackLecture extends Model
{
    use SoftDeletes;

    protected $table = 'track_lecture_videos';

    public $timestamps = true;

    protected $fillable = [
        'time_in_seconds',
        'student_id',
        'curriculam_lecture_id',
        'student_id',
        'course_id',
        'is_fully_watched'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function curriculam_lecture(): BelongsTo
    {
        return $this->belongsTo(CurriculamLecture::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
