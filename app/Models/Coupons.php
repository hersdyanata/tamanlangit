<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    use HasFactory;
    protected $table = 'coupons';
    protected $primaryKey = 'id';
    protected $fillable = [
        'code',
        'description',
        'status', // // A: Aktif, NA: Tidak Aktif, E: Kadaluarsa
        'start_date',
        'end_date',
        'quantity',
        'balance',
        'discount_type', // [ persentase / nominal ]
        'discount',
        'valid_for', // [ online / onsite / both ]
        'created_by',
        'updated_by'
    ];

    protected $attributes = [
        'status' => 'A',
    ];

    public function wahanas()
    {
        return $this->hasMany(CouponWahana::class, 'coupon_id', 'id');
    }
}
