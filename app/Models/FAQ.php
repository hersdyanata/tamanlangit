<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;
    protected $table = 'faqs';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'question', 'answer'
    ];
}
