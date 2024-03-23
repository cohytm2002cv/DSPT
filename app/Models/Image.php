<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_path',
        'name',
        'news_id'
    ];
    public function news()
    {
        return $this->hasOne(News::class);
    }
}
