<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $table = 'configurations';
    protected $primaryKey = false;
    public $timestamps = false;

    protected $fillable = [
        'prefix',
        'parameter',
        'description',
        'value',
    ];
}
