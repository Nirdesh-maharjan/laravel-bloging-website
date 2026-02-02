<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
    'user_id',
    'title',
    'slug',
    'category_id',
    'status',
    'image_path',
    'content',
];

    public function category()
{
    return $this->belongsTo(\App\Models\Category::class);
}

}
