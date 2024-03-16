<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Articles extends Model
{
    use HasFactory;
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $fillable = [
        'category_id',
        'title',
        'content',
        'status', // published, draft
        'tags',
        'count_views',
        'url',
        'created_by',
        'updated_by',
        'keywords',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            $article->url = Str::slug($article->title);
        });
    }

    public function category()
    {
        return $this->belongsTo(ArticleCategories::class, 'category_id','id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
}
