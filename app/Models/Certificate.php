<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Certificate extends Model
{
	use SoftDeletes;

	protected $table = 'certificates';

	public $timestamps = true;

	protected $fillable = [
		'student_id',
        'course_id',
        'file'
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
