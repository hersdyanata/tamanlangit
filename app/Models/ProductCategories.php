<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategories extends Model
{
    use HasFactory;
    protected $table = 'product_categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'created_by',
        'updated_by',
    ];

    public function products()
    {
        return $this->hasMany(Products::class, 'category_id', 'id');
    }
}
