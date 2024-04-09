<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
class CourseType extends Model
{
	use SoftDeletes;

	protected $table = 'course_types';

	public $timestamps = true;

	protected $fillable = [
		'title'
	];

	/**
     * @return HasMany
     * @description get the detail associated with the post
     */
    public function course(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
