<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TicketSerials extends Model
{
    use HasFactory;
    protected $table = 'ticket_serials';
    protected $keyType = 'string';
    protected $primaryKey = 'serial_number';
    public $timestamps = false;

    protected $fillable = [
        'ticket_id',
        'serial_number',
        'price',
        'status', // aktif / sold / expired
        'sold_date',
    ];

    public static function generateUniqueCode($ticket_id)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codeLength = 4;
        $code = '';

        while (strlen($code) < $codeLength) {
            $position = rand(0, strlen($characters) - 1);
            $character = $characters[$position];
            $code .= $character;
        }

        if (self::where('serial_number', $code)->where('ticket_id', $ticket_id)->exists()) {
            return self::generateUniqueCode($ticket_id);
        }

        return $code;
    }
}
