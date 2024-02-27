<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WahanaFacility extends Model
{
    use HasFactory;

    protected $table = 'wahana_facilities';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'wahana_id',
        'name',
    ];

    // public function wahana()
    // {
    //     return $this->belongsTo(Wahana::class, 'id', 'wahana_id');
    // }
}
