<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;

    protected $table = 'contacts';
    protected $primaryKey = false;
    public $timestamps = false;
    protected $fillable = [
        'phone_number',
        'mobile_number',
        'email',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'pinterest_url',
        'tiktok_url',
        'twitter_url',
    ];
}
