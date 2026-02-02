<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name','tagline',
        'logo_path','accent_color',
        'posts_per_page','allow_guest_posts',
        'comments_enabled','comments_require_approval',
        'meta_title','meta_description',
        'facebook_url','instagram_url','twitter_url','youtube_url',
    ];

    protected $casts = [
        'allow_guest_posts' => 'boolean',
        'comments_enabled' => 'boolean',
        'comments_require_approval' => 'boolean',
        'posts_per_page' => 'integer',
    ];
}
