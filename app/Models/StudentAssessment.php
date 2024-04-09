<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentAssessment extends Model
{
    use SoftDeletes;

    protected $table = 'student_assesments';

    public $timestamps = true;

    protected $fillable = [
        'student_id',
        'class_id',
        'subject_id',
        'marks',
        'created_by',
        'other_info',
        'assesment_file',
        'status',
        'started_date',
        'expired_date'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(ClassList::class);
    }
}
