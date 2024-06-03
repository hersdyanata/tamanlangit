<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketDirectSalesDetail extends Model
{
    use HasFactory;
    protected $table = 'ticket_direct_sales_details';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'trans_id',
        'ticket_id',
        'price',
        'quantity',
        'subtotal',
    ];

    public function ticket()
    {
        return $this->hasOne(TicketDirect::class, 'id', 'ticket_id');
    }

    public function parent()
    {
        return $this->hasOne(TicketDirectSales::class, 'id', 'trans_id');
    }
}
