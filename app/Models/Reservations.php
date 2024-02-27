<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Str;

class Reservations extends Model
{
    use HasFactory;

    protected $table = 'reservations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'trans_num',
        'trans_via', // onsite / online
        'start_date',
        'end_date',
        'night_count',
        'checkin_date',
        'checkout_date',
        'wahana_id',
        'room_id',
        'name',
        'email',
        'wa_number',
        'persons',
        'price',
        'subtotal',
        'ppn',
        'ppn_amount',
        'total_amount',
        'coupon_id',
        'discount',
        'discount_type',
        'discount_amount',
        'payment_status', // paid, unpaid, pending, cancel
        'cancel_flag',
        'cancel_reason',
        'complete_flag',
        'eo_id',
        'eo_commission',
        'eo_commission_type',
        'eo_total_commission',
        'omzet'
    ];

    public function wahana()
    {
        return $this->hasOne(Wahana::class,'id','wahana_id');
    }

    public function room()
    {
        return $this->hasOne(WahanaRoom::class, 'id', 'room_id');
    }

    public function payments()
    {
        return $this->hasMany(Payments::class, 'trans_id', 'id')->where('payment_for', '=', 'reservation');
    }

    public function eo()
    {
        return $this->hasOne(EventOrganizer::class, 'id', 'eo_id');
    }

    public function coupon()
    {
        return $this->hasOne(Coupons::class, 'id', 'coupon_id');
    }

    public static function generateUniqueCode()
    {
        $currentYear = Carbon::now()->format('y');
        $currentMonth = Carbon::now()->format('m');
    
        do {
            $randomCharacters = strtoupper(Str::random(4));    
            $uniqueCode = $currentYear . $currentMonth . $randomCharacters;
            $existingTransaction = self::where('trans_num', $uniqueCode)->exists();
        } while ($existingTransaction);
    
        return $uniqueCode;
    }    
}
