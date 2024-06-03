<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationExtraServices extends Model
{
    use HasFactory;
    protected $table = 'reservation_extra_services';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    protected $fillable = [
        'reservation_id',
        'type',
        'stock_id',
        'price',
        'quantity',
        'subtotal',
    ];

    public function stock()
    {
        return $this->hasOne(InventoryStock::class, 'id', 'stock_id');
    }
}
