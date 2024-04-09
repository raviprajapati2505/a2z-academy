<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PromoCode extends Model
{
    use SoftDeletes;

    protected $table = 'promo_codes';

    public $timestamps = true;

    protected $fillable = [
        'code',
        'valid_till',
        'discount_type',
        'discount_amount',
    ];
}
