<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Purchases extends Model
{
    use HasFactory;
    protected $table = 'purchases';
    protected $primaryKey = 'id';
    protected $fillable = [
        'trans_num',
        'trans_date',
        'supplier_id',
        'amount',
        'ppn',
        'ppn_amount',
        'total_amount',
        'non_stock',
        'created_by',
        'updated_by'
    ];

    public function items()
    {
        return $this->hasMany(PurchaseDetails::class, 'purchase_id', 'id');
    }

    public function supplier()
    {
        return $this->hasOne(Suppliers::class,'id','supplier_id');
    }

    public function creator()
    {
        return $this->hasOne(User::class,'id','created_by');
    }

    public static function generateUniqueCode()
    {
        // Get the current year and month
        $currentYear = Carbon::now()->format('y');
        $currentMonth = Carbon::now()->format('m');

        // Get the last used transaction number for the current year and month
        $lastTransaction = self::select('trans_num')
            ->where(DB::raw("SUBSTRING(trans_num, 1, 4)"), $currentYear . $currentMonth)
            ->orderBy('trans_num', 'desc')
            ->first();

        // If there is a previous transaction, check if it's in the same month
        if ($lastTransaction) {
            $lastTransactionYear = substr($lastTransaction->trans_num, 0, 2);
            $lastTransactionMonth = substr($lastTransaction->trans_num, 2, 2);

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

        // Concatenate the components to form the unique code
        $uniqueCode = $currentYear . $currentMonth . $formattedIncrementalNumber;

        return $uniqueCode;
    }

}
