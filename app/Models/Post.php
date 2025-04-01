<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    // protected $fillable = ['post', 'user_id'] ;

    protected $guarded = [];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

    public function likes(){
        return $this->morphMany(Like::class, 'likeable');
    }

    public function tags(){
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
