<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'isPublished',
        'user_id'
    ];
    
    
    public function comments()
    {
        return $this->hasMany(Comment::class); // hasMany - relacija
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'tag_post');
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }
}
