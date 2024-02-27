<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tickets extends Model
{
    use HasFactory;

    protected $table = 'tickets';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'code',
        'description',
        'valid_from',
        'valid_to',
        'quantity',
        'category',
        'status', // aktif, selesai
        'price',
        'created_by',
        'updated_by',
    ];

    public function serials()
    {
        return $this->hasMany(TicketSerials::class, 'ticket_id', 'id');
    }

    public function creator()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public static function generateUniqueCode()
    {
        $year = date('y');
        $month = date('m');
        $day = date('d');

        do {
            $randomCharacters = strtoupper(Str::random(2));
            $uniqueCode = $year . $month . $day . $randomCharacters;
            $existingCode = self::where('code', $uniqueCode)->first();
        } while ($existingCode);

        return $uniqueCode;
    }
}
