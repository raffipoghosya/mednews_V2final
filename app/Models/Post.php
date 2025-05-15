<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";
    public $timestamps = false;

    public function categories() {
        return $this->belongsToMany(Category::class, 'categories_posts', 'post_id', 'category_id');
    }
}
