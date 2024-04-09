<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
	use SoftDeletes;

	protected $table = 'teacher_notes';

	public $timestamps = true;

	protected $fillable = [
		'title',
		'description',
		'teacher_id'
	];
}
