<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;
    
    protected $table = 'menu';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'divider_id',
        'parent_id',
        'order',
        'icon',
        'route',
    ];

    public function children(){
        return $this->hasMany(self::class, 'parent_id')->orderBy('divider_id', 'asc');
    }
}
