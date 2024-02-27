<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryStock extends Model
{
    use HasFactory;

    protected $table = 'inventory_stocks';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'quantity',
        'min_stock_reminder',
        'last_purchase',
    ];

    public static function updateOrInsertStocks(array $purchaseDetails, $trans_date)
    {
        foreach ($purchaseDetails as $purchase) {
            $product_id = $purchase['product_id'];
            $quantity = $purchase['quantity'];

            // Check if a record with the given product_id exists
            $existingStock = self::where('product_id', $product_id)->first();

            if ($existingStock) {
                // Update the existing record
                $existingStock->update([
                    'quantity' => $existingStock->quantity + $quantity,
                    'last_purchase' => $trans_date
                ]);
            } else {
                // Insert a new record
                self::create([
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                    'last_purchase' => $trans_date
                ]);
            }
        }
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
}
