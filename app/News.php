<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    
    protected $fillable = [
        'title', 'slug', 'content','user_id','tag_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('display', true);
    }

    public function scopeUnpublished($query)
    {
        return $query->where('display', false);
    }
}
