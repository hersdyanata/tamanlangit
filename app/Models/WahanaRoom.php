<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WahanaRoom extends Model
{
    use HasFactory;

    protected $table = 'wahana_rooms';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'wahana_id',
        'name',
        'status', // A=aktif, RV=reserved, NA=tidak aktif
        'last_checkin' ,
    ];
}
