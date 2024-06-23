<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketCategories extends Model
{
    use HasFactory;

    protected $table = 'ticket_categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
    ];

    public function ticketDirect()
    {
        return $this->hasOne(TicketDirect::class, 'category', 'id');
    }

    public function ticketPresale()
    {
        return $this->hasMany(Tickets::class, 'category_id', 'id');
    }
}
