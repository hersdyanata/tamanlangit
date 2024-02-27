<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'category_id',
        'code',
        'name',
        'inventory_type',
        'created_by',
        'updated_by',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategories::class, 'category_id', 'id');
    }

    public static function generateUniqueCode()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codeLength = 8;
        $code = '';

        while (strlen($code) < $codeLength) {
            $position = rand(0, strlen($characters) - 1);
            $character = $characters[$position];
            $code .= $character;
        }

        if (self::where('code', $code)->exists()) {
            return self::generateUniqueCode();
        }

        return $code;
    }
}
