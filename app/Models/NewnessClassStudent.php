<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewnessClassStudent extends Model
{
	use SoftDeletes;

	protected $table = 'newness_class_students';

	public $timestamps = true;

	protected $fillable = [
		'newness_class_id',
		'student_id'
	];

	public function newness_class(): BelongsTo
	{
		return $this->belongsTo(NewnessClass::class);
	}

	public function student(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
