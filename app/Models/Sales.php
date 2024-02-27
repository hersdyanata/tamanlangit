<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'trans_num',
        'trans_date',
        'ppn',
        'ppn_amount',
        'amount',
        'total_amount',
        'payment_status',
        'created_by',
        'updated_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updater()
    {
        return $this->belongsTo(User::class,'updated_by', 'id');
    }

    public function items()
    {
        return $this->hasMany(SalesDetails::class,'sales_id','id');
    }

    public static function generateUniqueCode()
    {
        // Get the current year and month
        $currentYear = Carbon::now()->format('y');
        $currentMonth = Carbon::now()->format('m');

        // Get the last used transaction number for the current year and month
        $lastTransaction = self::select('trans_num')
            ->where(DB::raw("SUBSTRING(trans_num, 2, 4)"), $currentYear . $currentMonth)
            ->orderBy('trans_num', 'desc')
            ->first();

        // If there is a previous transaction, check if it's in the same month
        if ($lastTransaction) {
            $lastTransactionYear = substr($lastTransaction->trans_num, 1, 2);
            $lastTransactionMonth = substr($lastTransaction->trans_num, 3, 2);

            if ($lastTransactionYear == $currentYear && $lastTransactionMonth == $currentMonth) {
                // If in the same month, increment the transaction number
                $incrementalNumber = (int)substr($lastTransaction->trans_num, -4) + 1;
            } else {
                // If in a different month, reset the incremental number to 1
                $incrementalNumber = 1;
            }
        } else {
            // If no previous transaction, set the incremental number to 1
            $incrementalNumber = 1;
        }

        // Format the transaction number with leading zeros
        $formattedIncrementalNumber = str_pad($incrementalNumber, 4, '0', STR_PAD_LEFT);

        // Concatenate the components to form the unique code with "S" at the beginning
        $uniqueCode = 'S' . $currentYear . $currentMonth . $formattedIncrementalNumber;

        return $uniqueCode;
    }
}
