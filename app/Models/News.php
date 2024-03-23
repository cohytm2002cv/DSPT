<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class News extends Model
{
    protected $fillable = ['title', 'content', 'author', 'published_at', 'group_id','user_id','image_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function image()
    {
        return $this->belongsTo(Image::class);
    }

}

