<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['user_id','title','content','views','earning','blog_image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot() {
        parent::boot();
        static::creating(function ($blog) {
            $blog->blog_slug = Str::slug($blog->title);
        });
        static::updating(function ($blog) {
            $blog->blog_slug = Str::slug($blog->title);
        });
    }

    public function getRouteKeyName()
    {
        return 'blog_slug';
    }


}
