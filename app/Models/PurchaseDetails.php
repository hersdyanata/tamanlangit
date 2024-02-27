<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    use HasFactory;
    protected $table = 'purchase_details';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'purchase_id',
        'product_id',
        'quantity',
        'price',
        'subtotal'
    ];

    public function product()
    {
        return $this->hasOne(Products::class, 'id', 'product_id');
    }
}
