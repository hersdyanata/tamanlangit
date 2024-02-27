<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategories extends Model
{
    use HasFactory;
    protected $table = 'article_categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'url',
        'created_by',
        'updated_by',
    ];

    public function articles()
    {
        return $this->hasMany(Articles::class, 'category_id', 'id');
    }
}
