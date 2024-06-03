<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketDirectSales extends Model
{
    use HasFactory;
    
    protected $table = 'ticket_direct_sales';
    protected $primaryKey = 'id';
    protected $fillable = [
        'trans_num',
        'trans_date',
        'name',
        'amount',
        'created_by',
        'updated_by',
    ];

    public function details()
    {
        return $this->hasMany(TicketDirectSalesDetail::class, 'trans_id', 'id');
    }

    public static function generateUniqueCode()
    {
        $date = now()->format('ymd');
        $randomChars = strtoupper(substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4));
        $code = $date . $randomChars;

        $existingCode = self::where('trans_num', $code)->first();
        if ($existingCode) {
            return self::generateUniqueCode();
        }

        return $code;
    }
}
