<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentReview extends Model
{
    use SoftDeletes;

    protected $table = 'student_reviews';

    public $timestamps = true;

    protected $fillable = [
        'feedback_text',
        'student_id',
        'course_id',
        'newness_class_id',
        'star_rating'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function newness_class(): BelongsTo
    {
        return $this->belongsTo(NewnessClass::class);
    }
}
