<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'discordable', 'published', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }

    public static function booted()
    {
        static::addGlobalScope('published', function (Builder $builder) {
            $builder->where('published', 1);
        });
    }
}
