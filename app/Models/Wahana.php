<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wahana extends Model
{
    use HasFactory;

    protected $table = 'wahana';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
        'max_person',
        'room_wide',
        'room_available',
        'user_choose_room',
        'room_name',
        'price',
        'slug',
        'created_by',
        'updated_by',
        'keywords',
    ];

    public function rooms(){
        return $this->hasMany(WahanaRoom::class, 'wahana_id', 'id');
    }

    public function facilities(){
        return $this->hasMany(WahanaFacility::class, 'wahana_id', 'id');
    }
    
    public function images(){
        return $this->hasMany(WahanaImage::class, 'wahana_id', 'id');
    }

    public function creator(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function reservations(){
        return $this->hasMany(Reservations::class, 'wahana_id', 'id')->where('reservation_status', 'aktif');
    }
}
