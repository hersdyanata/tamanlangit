<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Str;
use App\Models\Payments;

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
        'reservation_status', // aktif, cancel, selesai
        'cancel_reason',
        'refund',
        'refund_status',
        'refund_date',
        'eo_id',
        'eo_commission',
        'eo_commission_type',
        'eo_total_commission',
        'omzet',
        'extra_bill',
        'snap_token',
        'payment_url',
        'payment_via',
        'va_number',
        'expiry_time'
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            Payments::where('payment_for', 'reservation')->where('trans_id', $model->id)->update(['status' => $model->payment_status]);
        });
    }

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

    public function extras()
    {
        return $this->hasMany(ReservationExtraServices::class, 'reservation_id', 'id');
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
