<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use SoftDeletes;

    protected $table = 'courses';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'cover_image',
        'video',
        'link',
        'is_paid',
        'price',
        'class_id',
        'subject_id',
        'teacher_id',
        'created_by',
        'status',
        'type',
        'course_type_id',
        'language',
        'special_price',
        'short_description',
        'what_you_learn',
        'instructor_infromation',
        'ceu_points',
        'child_category_id',
        'delivery_mode_id'
    ];

    public function class(): BelongsTo
    {
        return $this->belongsTo(ClassList::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course_type(): BelongsTo
    {
        return $this->belongsTo(CourseType::class);
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function student_course_history(): HasMany
    {
        return $this->hasMany(StudentCourseHistory::class);
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function course_curriculam(): HasMany
    {
        return $this->hasMany(CourseCurriculam::class, 'course_id');
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function curriculam_lecture(): HasMany
    {
        return $this->hasMany(CurriculamLecture::class, 'course_id');
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function student_review(): HasMany
    {
        return $this->hasMany(StudentReview::class, 'course_id');
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function student_favourite(): HasMany
    {
        return $this->hasMany(StudentFavourite::class, 'course_id');
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function course_material(): HasMany
    {
        return $this->hasMany(CourseMaterial::class, 'course_id');
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function certificate(): HasMany
    {
        return $this->hasMany(Certificate::class, 'course_id');
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function track_lecture(): HasMany
    {
        return $this->hasMany(TrackLecture::class, 'student_id');
    }
}
