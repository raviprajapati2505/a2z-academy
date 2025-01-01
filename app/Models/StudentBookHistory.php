<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentBookHistory extends Model
{
    use SoftDeletes;

    protected $table = 'student_book_history';

    public $timestamps = true;

    protected $fillable = [
        'book_id',
        'student_id',
        'is_paid'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
