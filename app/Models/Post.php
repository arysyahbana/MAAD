<?php

namespace App\Models;

use Cohensive\OEmbed\Facades\OEmbed;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Post extends Model
{
    use HasFactory, HasApiTokens, Sluggable;

    public function rCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function rUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function rLike()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getVideoAttribute($value)
    {
        $embed = OEmbed::get($value);
        if ($embed) {
            return $embed->html(['width' => 200]);
        }
    }
}
