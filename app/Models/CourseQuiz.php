<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseQuiz extends Model
{
    use SoftDeletes;

    protected $table = 'quizzes';

    public $timestamps = true;

    protected $fillable = [
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'sorting',
        'correct_answer',
        'status',
        'class_id',
        'subject_id',
        'video_course_id',
        'user_id'
    ];
}    