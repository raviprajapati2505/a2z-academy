<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NewnessClass extends Model
{
    use SoftDeletes;

    protected $table = 'newness_classes';

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
        'user_id',
        'tags',
        'date',
        'time_from',
        'time_to',
        'class_id',
        'subject_id',
        'teacher_id',
        'created_by',
        'is_live',
        'zoom_join_url',
        'zoom_start_url'
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

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'newness_class_students', 'newness_class_id', 'student_id');
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function student_review(): HasMany
    {
        return $this->hasMany(StudentReview::class, 'newness_class_id');
    }

    /**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function student_favourite(): HasMany
    {
        return $this->hasMany(StudentFavourite::class, 'newness_class_id');
    }
}
