<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentCourseHistory extends Model
{
    use SoftDeletes;

    protected $table = 'student_course_history';

    public $timestamps = true;

    protected $fillable = [
        'course_id',
        'student_id',
        'is_paid'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
