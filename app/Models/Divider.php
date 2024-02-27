<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divider extends Model
{
    use HasFactory;

    protected $table = 'divider';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'order',
    ];

    public function menus(){
        return $this->hasMany(MenuItem::class, 'divider_id');
    }
}
