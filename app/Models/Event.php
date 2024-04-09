<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
	use SoftDeletes;

	protected $table = 'events';

	public $timestamps = true;

	protected $fillable = [
		'datetime',
		'type',
		'description',
		'user_id',
		'created_by'
	];
}
