<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
	use SoftDeletes;

	protected $table = 'teacher_notes';

	public $timestamps = true;

	protected $fillable = [
		'title',
		'description',
		'teacher_id',
        'subject_id',
        'type'
	];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
