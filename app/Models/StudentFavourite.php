<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentFavourite extends Model
{
    use SoftDeletes;

    protected $table = 'student_favourites';

    public $timestamps = true;

    protected $fillable = [
        'student_id',
        'course_id',
        'newness_class_id'
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
