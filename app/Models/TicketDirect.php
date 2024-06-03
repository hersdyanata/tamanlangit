<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketDirect extends Model
{
    use HasFactory;

    protected $table = 'ticket_direct';
    protected $primaryKey = 'id';
    protected $fillable = [
        // 'code',
        'category',
        'price',
        'created_by',
        'updated_by'
    ];

    public function creator()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function category_()
    {
        return $this->hasOne(TicketCategories::class, 'id', 'category');
    }

    public function sales()
    {
        return $this->hasMany(TicketDirectSalesDetail::class, 'ticket_id', 'id');
    }
}
