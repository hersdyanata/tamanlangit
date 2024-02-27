<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WahanaImage extends Model
{
    use HasFactory;

    protected $table = 'wahana_images';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'wahana_id',
        'image_path',
    ];
}
