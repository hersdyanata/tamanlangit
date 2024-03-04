<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketSales extends Model
{
    use HasFactory;
    protected $table = 'ticket_sales';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'trans_type', // bulk, direct
        'ticket_batch_id',
        'serial_number',
        'category',
        'price',
        'sold_date',
        'created_by'
    ];

    public function creator()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function bulk()
    {
        return $this->hasOne(Tickets::class, 'id', 'ticket_batch_id');
    }

    public static function generateUniqueCode()
    {
        $date = now()->format('ymd');
        $randomChars = strtoupper(substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4));
        $code = $date . $randomChars;

        $existingCode = self::where('serial_number', $code)->first();
        if ($existingCode) {
            return self::generateUniqueCode();
        }

        return $code;
    }
}
