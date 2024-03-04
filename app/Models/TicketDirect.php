<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketDirect extends Model
{
    use HasFactory;

    protected $table = 'ticket_directs';
    protected $primaryKey = 'id';
    protected $fillable = [
        // 'code',
        'category',
        'description',
        'price',
        'created_by',
        'updated_by'
    ];

    public function creator()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
