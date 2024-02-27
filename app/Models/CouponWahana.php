<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponWahana extends Model
{
    use HasFactory;
    protected $table = 'coupon_wahana';
    protected $primaryKey = 'false';
    public $timestamps = false;
    protected $fillable = [
        'coupon_id',
        'wahana_id'
    ];

    public function coupon()
    {
        return $this->belongsTo(Coupons::class, 'id', 'coupon_id');
    }

    public function wahana()
    {
        return $this->hasOne(Wahana::class, 'id', 'wahana_id');
    }
}
