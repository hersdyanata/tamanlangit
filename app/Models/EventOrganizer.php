<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventOrganizer extends Model
{
    use HasFactory;
    protected $table = 'event_organizers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'commission',
        'commission_type',
        'created_by',
        'updated_by'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservations::class, 'eo_id', 'id');
    }
}
